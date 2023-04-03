<?php

namespace App\Http\Controllers;

use App\Enums\ProjectStatus;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\User;
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
        $projects = Project::filter(request()->only('search'))
            ->with('tasks', 'client')
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
        $clients = auth()->user()->is_admin ? User::select(['name', 'id'])
            ->where('is_admin', false)
            ->has('projects')
            ->latest()
            ->get()
            : collect();

        return Inertia::render("Projects/Create", ["clients" => $clients]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        try {
            /* If an admin creates a custom project, store it as if the assigned user created it.*/
            $user = auth()->user();
            if ($request->validated()['user_id']) {
                $user = User::findOrFail($request->validated()['user_id']);
            }
            $user->projects()->create($request->validated());
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
        $project->load([
            'client' => function ($query) {
                $query->select('id', 'name');
            },
            'tasks'
        ]);

        return Inertia::render("Projects/Show", compact('project'));
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
