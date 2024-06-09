<?php

namespace App\Http\Controllers;

use App\Models\Task;

use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::paginate(10);
        $metaData  = Helper::getMetaData($tasks);
        //return response()->json($tasks);
        return Response::success(200, 'Task retrieved successfully', ['tasks' => $tasks->items()], $metaData);
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        return Response::success(200, 'Task retrieved successfully', ['task' => $task],  $metaData = []);
    }

    public function store(TaskRequest $request)
    {
        $task = Task::create($request->all());
        return Response::success(201, 'Task  created successfully', ['task ' => $task ]);
    }

    public function update(TaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->all());
        return Response::success(200, 'Task updated successfully', ['task' => $task]);
    }

    public function destroy($id)
    {
        Task::destroy($id);
        return Response::success(200, 'Task deleted successfully', ['task' => $task]);
    }
}
