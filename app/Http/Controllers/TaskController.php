<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
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
            Task::with('project')
            ->when(!auth()->user()->is_admin, fn ($query) => $query->where("user_id", auth()->user()->id))
            ->latest()->paginate();

        return Inertia::render("Tasks/Index", [
            "tasks" => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        try {
            $this->user()->tasks->create($request->validated());
        } catch (\Throwable $th) {
            return back()->withErrors($request);
        } finally {
            return to_route('tasks.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return $task;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
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
