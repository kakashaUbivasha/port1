<?php

namespace App\Service;

use App\Models\Task;

class TaskService
{
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
        Task::create($fields);
        return $project->tasks;
    }
}
