<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index($projectId, $taskId)
    {
        $user = auth()->user();
        $project = Project::where('owner_id', $user->id)->findOrFail($projectId);
        $task = $project->tasks()->findOrFail($taskId);
        return response()->json(['comments'=>$task->comments], 200);
    }
}
