<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return response()->json($user->myProjects);
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
    public function show($id)
    {
        $user = auth()->user();
        $project = Project::where('owner_id', $user->id)->findOrFail($id);
        return response()->json($project);
    }
    public function update(ProjectRequest $request, $id)
    {
        $user = auth()->user();
        $data = $request->validated();
        $project = Project::where('owner_id', $user->id)->findOrFail($id);
        $project->update([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);
        return response()->json('Project updated!');
    }
    public function destroy($id)
    {
        $user = auth()->user();
        $project = Project::where('owner_id', $user->id)->findOrFail($id);
        $project->delete();
        return response()->json('Project deleted!');
    }
}
