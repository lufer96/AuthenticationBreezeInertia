<?php

namespace App\Http\Controllers\Task;

use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Task\Requests\DeleteTaskRequest;
use App\Http\Controllers\Task\Requests\StoreTaskRequest;
use App\Http\Controllers\Task\Requests\UpdateTaskRequest;
use App\Http\Task\Resources\TaskResource;
use Exception;

class TaskController extends Controller
{

    public function __construct(private TaskRepository $taskRepository)
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TaskResource::collection(
            $this->taskRepository->getPaginated()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        try {
            $task = $this->taskRepository->create($request->all());
            return response()->json([
                'message' => 'Task created successfully',
                'task' => new TaskResource($task),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "message" => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        if (!$task)
            return response()->json([
                'error' => 'Task not found',
                'message' => 'The task does not exist',
            ], 404);

        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        try {
            $task = $this->taskRepository->update($request->all(), $task);
            return response()->json([
                'message' => 'Task updated successfully',
                'task' => new TaskResource($task),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "message" => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteTaskRequest $request, Task $task)
    {
        try {
            $this->taskRepository->delete($task);
            return response()->json([
                'message' => 'Task deleted successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "message" => $e->getMessage(),
            ], 500);
        }
    }
}
