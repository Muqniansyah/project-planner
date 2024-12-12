<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Project;
use App\Models\ProjectDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProjectDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        return view('proyek.detail', compact('project'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $task = new ProjectDetail();
        Log::info($request->all());

        $request->validate([
            'text' => 'required|string',
            'start_date' => 'required|date',
            'duration' => 'required|integer',
            'progress' => 'nullable|numeric|min:0|max:1',
            'parent' => 'nullable|integer',
            'project_id' => 'required|exists:projects,id', // Pastikan project_id valid
        ]);

        $task->text = $request->text;
        $task->start_date = $request->start_date;
        $task->duration = $request->duration;
        $task->progress = $request->has("progress") ? $request->progress : 0;
        $task->parent = $request->parent;
        $task->project_id = $request->project_id;

        $task->save();

        return response()->json([
            "action" => "inserted",
            "tid" => $task->id
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectDetail $projectDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectDetail $projectDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $task = ProjectDetail::find($id);

        $task->text = $request->text;
        $task->start_date = $request->start_date;
        $task->end_date = $request->end_date;
        $task->duration = $request->duration;
        $task->progress = $request->has("progress") ? $request->progress : 0;
        $task->parent = $request->parent;

        $task->save();

        return response()->json([
            "action" => "updated"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = ProjectDetail::find($id);
        $task->delete();

        return response()->json([
            "action" => "deleted"
        ]);
    }
}