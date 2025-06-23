<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CommentRequest;
use App\Models\Comment;
use App\Models\Project;
use App\Service\CommentService;
use App\Service\GlobalService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index($project_id, $task_id, GlobalService $service)
    {
        $user = auth()->user();
        $project = $service->checkProject($user->id, $project_id);
        $task = $project->tasks()->findOrFail($task_id);
        return response()->json(['comments'=>$task->comments], 200);
    }
    public function store(CommentRequest $request, $project_id, $task_id, GlobalService $service, CommentService $commentService)
    {
        $user = auth()->user();
        $data = $request->validated();
        $project = $service->checkProject($user->id, $project_id);
        $task = $project->tasks()->findOrFail($task_id);
        $comment = $commentService->createComment($user->id, $task->id, $data);
        return response()->json(['comments'=>$comment], 200);
    }
    public function update(CommentRequest $request, $project_id, $task_id, $comment_id, GlobalService $service, CommentService $commentService)
    {
        $user = auth()->user();
        $data = $request->validated();
        $project = $service->checkProject($user->id, $project_id);
        $task = $project->tasks()->findOrFail($task_id);
        $comment = $task->comments()->findOrFail($comment_id);
        $comment->update($data);
        return response()->json(['comment'=>$comment], 200);
    }
    public function destroy($project_id, $task_id, $comment_id, GlobalService $service, CommentService $commentService){
        $user = auth()->user();
        $project = $service->checkProject($user->id, $project_id);
        $task = $project->tasks()->findOrFail($task_id);
        $comment = $task->comments()->findOrFail($comment_id);
        $comment->delete();
        return response()->json(['message'=>'Комментарий удалён'], 200);
    }
}
