<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = auth()->user()->projects()->latest()->paginate(10);
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        auth()->user()->projects()->create($validated);

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $this->authorizeAccess($project);
        $project->load('tasks');
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $this->authorizeAccess($project);
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $this->authorizeAccess($project);

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string|max:255',
            'status' => 'sometimes|in:active,archived',
        ]);

        $project->update($validated);

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $this->authorizeAccess($project);
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully!');
    }

    /**
     * Ensure the user owns the project.
     */
    protected function authorizeAccess(Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403);
        }
    }
}
