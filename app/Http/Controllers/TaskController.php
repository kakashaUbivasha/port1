<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\TaskRequest;
use App\Models\Project;
use App\Models\Task;
use App\Service\GlobalService;
use App\Service\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index($id, GlobalService $service)
    {
        $user = auth()->user();
        $project = $service->checkProject($user->id, $id);
        return response()->json($project->tasks, 200);
    }
    public function store(TaskRequest $request, $id, TaskService $taskService, GlobalService $service)
    {
        $user = auth()->user();
        $project = $service->checkProject($user->id, $id);
        $data = $request->validated();
        $tasks = $taskService->createTask($user->id,$project, $data);
        return response()->json(['message'=>'Task created', 'tasks'=>$tasks], 200);
    }
    public function show($id,$task_id, GlobalService $service)
    {
        $user = auth()->user();
        $project = $service->checkProject($user->id, $id);
        $task = $project->tasks()->findOrFail($task_id);
        return response()->json($task, 200);
    }
    public function update(TaskRequest $request, $id, $task_id, TaskService $taskService)
    {
        $user = auth()->user();
        $data = $request->validated();
        $task = $taskService->updateTask($user->id, $id, $task_id, $data);
        return response()->json(['message'=>'Task updated', 'task'=>$task], 200);
    }
    public function destroy($id,$task_id, TaskService $taskService)
    {
        $user = auth()->user();
        try{
            $taskService->deleteTask($user->id, $id, $task_id);
            return response()->json(['message'=>'Task deleted', 'task'=>$task_id], 200);
        }catch (\Exception $e){
            return response()->json(['message'=>'Task not deleted', 'reason'=>$e->getMessage()], 400);
        }

    }
}
