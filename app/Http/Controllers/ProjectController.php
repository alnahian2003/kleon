<?php

namespace App\Http\Controllers;

use App\Enums\ProjectStatus;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Project::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('tasks', 'client')
            ->withCount('tasks')
            ->when(!auth()->user()->is_admin, fn ($query) => $query->where('user_id', auth()->user()->id))
            ->latest()
            ->paginate(10);

        return Inertia::render('Projects/Index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("Projects/Create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        try {
            auth()->user()->projects()->create($request->validated());
        } catch (\Throwable $th) {
            return back()->withErrors($request);
        } finally {
            return to_route('projects.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return Inertia::render("Projects/Show", [
            "project" => $project,
            "tasks" => $project->tasks
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return Inertia::render('Projects/Edit', ['project' => $project, 'statuses' => ProjectStatus::cases()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->updateOrFail($request->validated());

        return to_route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->deleteOrFail();
        return to_route('projects.index');
    }
}
