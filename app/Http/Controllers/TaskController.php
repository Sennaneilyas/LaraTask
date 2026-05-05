<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        $this->authorizeProject($project);
        $tasks = $project->tasks()->latest()->get();
        return view('projects.tasks.index', compact('project', 'tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        $this->authorizeProject($project);
        return view('projects.tasks.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        $this->authorizeProject($project);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'is_completed' => 'nullable|boolean',
        ]);

        $project->tasks()->create($validated);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project, Task $task)
    {
        $this->authorizeProject($task->project);
        return view('projects.tasks.show', compact('project', 'task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, Task $task)
    {
        $this->authorizeProject($task->project);
        return view('projects.tasks.edit', compact('project', 'task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, Task $task)
    {
        $this->authorizeProject($task->project);

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'is_completed' => 'sometimes|boolean',
        ]);

        $task->update($validated);

        return redirect()->route('projects.tasks.show', compact('project', 'task'))
            ->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, Task $task)
    {
        $this->authorizeProject($task->project);
        $task->delete();

        return redirect()->route('projects.show', $project)
            ->with('success', 'Task deleted successfully!');
    }

    /**
     * Authorize project access.
     */
    protected function authorizeProject(Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403);
        }
    }
}
