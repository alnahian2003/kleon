<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Return all tasks with relations for admin.
        $tasks =
            Task::filter(request()->only('search'))
            ->with('project')
            ->when(!auth()->user()->is_admin, fn ($query) => $query->where("user_id", auth()->user()->id))
            ->latest()->paginate(9);

        return Inertia::render("Tasks/Index", [
            "tasks" => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::select('title', 'id')
            ->when(!auth()->user()->is_admin, fn ($query) => $query->where('user_id', auth()->user()->id))
            ->latest()
            ->get();

        return Inertia::render("Tasks/Create", [
            "projects" => $projects
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        try {
            auth()->user()->tasks()->create($request->validated());
        } catch (\Throwable $th) {
            return back()->withErrors($request);
        } finally {
            return to_route('tasks.index');
        }
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Task $task)
    // {
    //     return $task;
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $projects = Project::select('title', 'id')
            ->when(!auth()->user()->is_admin, fn ($query) => $query->where('user_id', auth()->user()->id))
            ->latest()
            ->get();

        return Inertia::render("Tasks/Edit", [
            "task" => $task,
            "projects" => $projects,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTaskRequest $request, Task $task)
    {
        $task->updateOrFail($request->validated());
        return to_route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->deleteOrFail();
        return to_route('tasks.index');
    }
}
