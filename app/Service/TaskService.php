<?php

namespace App\Service;

use App\Models\Project;
use App\Models\Task;

class TaskService
{
    protected $globalService;

    public function __construct(GlobalService $globalService)
    {
        $this->globalService = $globalService;
    }
    public function createTask($user_id, $project, $data)
    {
        $fields = [
            'name'=> $data['name'],
            'description' => $data['description'],
            'project_id' => $project->id,
            'created_by'=>$user_id,
            'assigned_to'=>$data['assigned_to']??null,
            'due_date'=>$data['due_date'],
        ];
        if (isset($data['status'])) {
            $fields['status'] = $data['status'];
        }
        if (isset($data['priority'])) {
            $fields['priority'] = $data['priority'];
        }
        $task = Task::create($fields);
        if(isset($data['tags']))
        {
            $task->tags()->attach($data['tags']);
        }
        return $project->tasks;
    }
    public function updateTask($userId, $projectId, $task_id, $data)
    {
        $project =  $this->globalService->checkProject($userId, $projectId);
        $task = $project->tasks()->findOrFail($task_id);
        $task->update($data);
        if(isset($data['tags']))
        {
            $task->tags()->sync($data['tags']);
        }
        return $task;
    }
    public function deleteTask($userId, $projectId, $task_id)
    {
        $project =  $this->globalService->checkProject($userId, $projectId);
        if(!$project)
        {
            throw new \Exception("Project not found");
        }
        $task = $project->tasks()->findOrFail($task_id);
        if(!$task)
        {
            throw new \Exception("Task not found");
        }
        $task->delete();
        $task->tags()->detach();
    }
}
