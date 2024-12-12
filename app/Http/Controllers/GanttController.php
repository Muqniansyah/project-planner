<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Project;
use App\Models\ProjectDetail;
use Illuminate\Http\Request;

class GanttController extends Controller
{

    public function get(Project $project)
    {
        $tasks = new ProjectDetail();
        $links = new Link();

        return response()->json([
            'tasks' => $tasks->all()->where('project_id', $project->id),
            'links' => $links->all(),
        ]);
    }
}
