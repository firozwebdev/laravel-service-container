<?php

namespace App\Http\Controllers;

use App\Models\Task;

use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index()
    {
        try {
            $tasks = Task::paginate(10);
            $metaData = Helper::getMetaData($tasks);
            return Response::success(200, 'Task retrieved successfully', ['tasks' => $tasks->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $task = Task::find($id);
            if (!$task) {
                return Response::notFound('Sorry, Task not found!', 404);
            }
            return Response::success(200, 'Task retrieved successfully', ['task' => $task], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Task retrieval failed', 500);
        }
    }

    public function store(TaskRequest $request)
    {
        try {
            $task = Task::create($request->all());
            return Response::success(201, 'Task created successfully', ['task' => $task]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Task creation failed');
        }
    }

    public function update(TaskRequest $request, string $id)
    {
        try {
            $task = Task::find($id);
            if (!$task) {
                return Response::notFound(404, 'Task not found');
            }

            $task->update($request->all());
            return Response::success(200, 'Task updated successfully', ['task' => $task]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Task updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $task = Task::find($id);
            if (!$task) {
                return Response::notFound(404, 'Task not found');
            }

            $task->delete();
            return Response::success(200, 'Task deleted successfully', ['task' => $task]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Task deletion failed');
        }
    }
}
