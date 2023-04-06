<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Return all tasks with relations for admin.
        $tasks = Task::userTasks()
            ->with('project:id,slug')
            ->filter(request()->only('search'))
            ->latest()
            ->paginate(9);

        return TaskResource::collection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = auth()->user()
            ->tasks()
            ->create($request->validated());

        return response()->json(["data" => new TaskResource($task)], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTaskRequest $request, Task $task)
    {
        $task->updateOrFail($request->validated());

        return response()->json(['data' => $task], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->deleteOrFail();

        return response()->json(['message' => 'Task deleted successfully'], Response::HTTP_ACCEPTED);
    }
}
