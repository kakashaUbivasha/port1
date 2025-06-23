<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\ProjectRequest;
use App\Models\Project;
use App\Service\GlobalService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(GlobalService $service)
    {
        $user = auth()->user();
        $projects = Project::where('owner_id', $user->id)->orWhere('performers_id', $user->id)->get();
        return response()->json(['projects'=>$projects], 200);
    }
    public function store(ProjectRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        Project::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'owner_id'=>$user->id
        ]);
        return response()->json('Project created!');
    }
    public function show($id, GlobalService $service)
    {
        $user = auth()->user();
        $project = $service->checkProject($user->id, $id);
        return response()->json($project);
    }
    public function update(ProjectRequest $request, $id, GlobalService $service)
    {
        $user = auth()->user();
        $data = $request->validated();
        $project = $service->checkProject($user->id, $id);
        $project->update([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);
        return response()->json('Project updated!');
    }
    public function destroy($id, GlobalService $service)
    {
        $user = auth()->user();
        $project = $service->checkProject($user->id, $id);
        $project->delete();
        return response()->json('Project deleted!');
    }
}
