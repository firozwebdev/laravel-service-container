<?php

namespace App\Http\Controllers;

use App\Models\Lesson;

use App\Http\Requests\LessonRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class LessonController extends Controller
{
    public function index()
    {
        try {
            $lessons = Lesson::paginate(10);
            $metaData = Helper::getMetaData($lessons);
            return Response::success(200, 'Lesson retrieved successfully', ['lessons' => $lessons->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $lesson = Lesson::find($id);
            if (!$lesson) {
                 return Response::notFound(404, 'Lesson not found');
            }
            return Response::success(200, 'Lesson retrieved successfully', ['lesson' => $lesson], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Lesson retrieval failed', 500);
        }
    }

    public function store(LessonRequest $request)
    {
        try {
            $lesson = Lesson::create($request->all());
            return Response::success(201, 'Lesson created successfully', ['lesson' => $lesson]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Lesson creation failed');
        }
    }

    public function update(LessonRequest $request, string $id)
    {
        try {
            $lesson = Lesson::find($id);
            if (!$lesson) {
                 return Response::notFound(404, 'Lesson not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $lesson->update($validatedData);
            return Response::success(200, 'Lesson updated successfully', ['lesson' => $lesson]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Lesson updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $lesson = Lesson::find($id);
            if (!$lesson) {
                return Response::notFound(404, 'Lesson not found');
            }

            $lesson->delete();
            return Response::success(200, 'Lesson deleted successfully', ['lesson' => $lesson]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Lesson deletion failed');
        }
    }
}
