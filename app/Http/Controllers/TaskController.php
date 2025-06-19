<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\TaskRequest;
use App\Models\Project;
use App\Models\Task;
use App\Service\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index($id)
    {
        $user = auth()->user();
        $project = Project::where('owner_id', $user->id)->findOrFail($id);
        return response()->json($project->tasks, 200);
    }
    public function store(TaskRequest $request, $id, TaskService $taskService)
    {
        $user = auth()->user();
        $project = Project::where('owner_id', $user->id)->findOrFail($id);
        $data = $request->validated();
        $tasks = $taskService->createTask($user->id,$project, $data);
        return response()->json(['message'=>'Task created', 'tasks'=>$tasks], 200);
    }
}
