<?php

namespace App\Service;

use App\Models\Project;

class GlobalService
{
    public function checkProject($userId, $projectId)
    {
        return Project::where('id', $projectId)
            ->where(function ($query) use ($userId) {
                $query->where('owner_id', $userId)
                    ->orWhere('performers_id', $userId);
            })
            ->firstOrFail();
    }
}
