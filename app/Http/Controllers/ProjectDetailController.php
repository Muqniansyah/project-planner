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

        // Tanggal mulai proyek (statis: 5 Desember 2024)
        $projectStartDate = strtotime($project->start_date);
        $projectEndDate = strtotime($project->end_date); // Contoh: Proyek berjalan 3 bulan

        // Total minggu proyek
        $totalWeeks = ceil(($projectEndDate - $projectStartDate) / (7 * 86400));

        // Ambil semua task dari database
        $tasks = ProjectDetail::where('project_id', $project->id)->get();

        // Buat array untuk progres kumulatif per minggu
        $weeklyProgress = array_fill(1, $totalWeeks, 0);

        foreach ($tasks as $task) {
            $startDate = strtotime($task->start_date);
            $durationInDays = $task->duration;
            $endDate = $startDate + ($durationInDays * 86400);

            // Hitung minggu mulai dan selesai (berdasarkan proyek)
            $startWeek = ceil(($startDate - $projectStartDate) / (7 * 86400)) + 1;
            $endWeek = ceil(($endDate - $projectStartDate) / (7 * 86400)) + 1;

            // Pastikan minggu dalam rentang proyek
            $startWeek = max(1, $startWeek);
            $endWeek = min($totalWeeks, $endWeek);

            // Hitung progres harian
            $progressPerDay = $task->progress / $durationInDays;

            // Distribusikan progres ke setiap minggu
            for ($week = $startWeek; $week <= $endWeek; $week++) {
                // Hitung hari efektif di minggu ini
                $weekStartDate = $projectStartDate + (($week - 1) * 7 * 86400);
                $weekEndDate = $weekStartDate + (6 * 86400);

                $effectiveStartDate = max($startDate, $weekStartDate);
                $effectiveEndDate = min($endDate, $weekEndDate);

                $daysInWeek = max(0, ($effectiveEndDate - $effectiveStartDate) / 86400 + 1);

                // Tambahkan progres ke minggu ini
                $weeklyProgress[$week] += $progressPerDay * $daysInWeek;
            }
        }

        // Hitung progres kumulatif per minggu
        $cumulativeProgress = [];
        $totalProgress = 0;

        foreach ($weeklyProgress as $progress) {
            $totalProgress += $progress;
            $cumulativeProgress[] = min(100, $totalProgress * 100); // Maksimal 100%
        }

        return view('proyek.detail', compact('project', 'tasks', 'cumulativeProgress', 'projectStartDate', 'totalWeeks'));
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
