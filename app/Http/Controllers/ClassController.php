<?php

namespace App\Http\Controllers;

use App\Models\Class;

use App\Http\Requests\ClassRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class ClassController extends Controller
{
    public function index()
    {
        try {
            $classes = Class::paginate(10);
            $metaData = Helper::getMetaData($classes);
            return Response::success(200, 'Class retrieved successfully', ['classes' => $classes->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $class = Class::find($id);
            if (!$class) {
                 return Response::notFound(404, 'Class not found');
            }
            return Response::success(200, 'Class retrieved successfully', ['class' => $class], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Class retrieval failed', 500);
        }
    }

    public function store(ClassRequest $request)
    {
        try {
            $class = Class::create($request->all());
            return Response::success(201, 'Class created successfully', ['class' => $class]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Class creation failed');
        }
    }

    public function update(ClassRequest $request, string $id)
    {
        try {
            $class = Class::find($id);
            if (!$class) {
                 return Response::notFound(404, 'Class not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $class->update($validatedData);
            return Response::success(200, 'Class updated successfully', ['class' => $class]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Class updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $class = Class::find($id);
            if (!$class) {
                return Response::notFound(404, 'Class not found');
            }

            $class->delete();
            return Response::success(200, 'Class deleted successfully', ['class' => $class]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Class deletion failed');
        }
    }
}
