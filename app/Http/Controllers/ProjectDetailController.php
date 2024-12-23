<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Project;
use App\Models\ProjectDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ProjectDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Project $project)
    {
        // Tanggal mulai proyek dan akhir proyek
        $projectStartDate = strtotime($project->start_date);
        $projectEndDate = strtotime($project->end_date);

        // Total minggu proyek
        $totalWeeks = ceil(($projectEndDate - $projectStartDate) / (7 * 86400));

        // Ambil semua task berdasarkan project ID
        $tasks = ProjectDetail::where('project_id', $project->id)->get();

        // Inisialisasi progres mingguan
        $weeklyProgress = array_fill(0, $totalWeeks, 0); // Nilai awal 0 untuk semua minggu

        // Iterasi melalui setiap minggu
        for ($week = 0; $week < $totalWeeks; $week++) {
            $weekStartDate = $projectStartDate + ($week * 7 * 86400);
            $weekEndDate = $weekStartDate + (7 * 86400) - 1;

            $progressThisWeek = 0; // Total progres minggu ini
            $tasksInWeek = 0;     // Jumlah task aktif minggu ini

            // Iterasi setiap task
            foreach ($tasks as $task) {
                $taskStartDate = strtotime($task->start_date);
                $taskEndDate = $taskStartDate + ($task->duration * 86400);

                // Cek apakah task ini aktif dalam minggu ini
                if ($taskEndDate >= $weekStartDate && $taskStartDate <= $weekEndDate) {
                    $tasksInWeek++; // Hitung task yang aktif minggu ini

                    // Hitung progres task dalam skala 0–1
                    $progress = $task->progress / 100;

                    // Jika task dimulai sebelum minggu ini, hanya hitung bagian minggu ini
                    if ($taskStartDate < $weekStartDate) {
                        $overlapDays = min($taskEndDate, $weekEndDate) - $weekStartDate + 1;
                    } else {
                        $overlapDays = min($taskEndDate, $weekEndDate) - $taskStartDate + 1;
                    }

                    $progressThisWeek += ($progress * ($overlapDays / ($task->duration * 86400)));
                }
            }

            // Rata-rata progres minggu ini (dibagi total task dalam proyek, termasuk task yang belum aktif)
            $weeklyProgress[$week] = $tasks->count() > 0 ? ($progressThisWeek / $tasks->count()) : 0;
        }

        // Hitung progres kumulatif mingguan
        $cumulativeProgress = [];
        $totalCumulativeProgress = 0;

        foreach ($weeklyProgress as $week => $progress) {
            $totalCumulativeProgress += $progress;
            $cumulativeProgress[$week] = min(1, $totalCumulativeProgress); // Batasi maksimal 1 (100%)
        }

        // Konversi progres kumulatif ke persen untuk ditampilkan
        $cumulativeProgressPercentage = array_map(fn($value) => $value * 10000, $cumulativeProgress);

        // Log untuk debugging
        Log::info('Weekly progress calculation', ['weekly_progress' => $cumulativeProgressPercentage]);

        return view('proyek.detail', compact('project', 'tasks', 'cumulativeProgressPercentage', 'projectStartDate', 'totalWeeks'));
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

        if($task->progress == 1)
        {
            $task->status = "Completed";
        } elseif($task->progress > 0)
        {
            $task->status = "In Progress";
        }

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
