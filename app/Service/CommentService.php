<?php

namespace App\Service;

use App\Models\Comment;

class CommentService
{
    public function createComment($userId, $taskId, $data)
    {
        return Comment::create([
            'user_id' => $userId,
            'task_id' => $taskId,
            'comment' => $data['comment'],
        ]);
    }
}
