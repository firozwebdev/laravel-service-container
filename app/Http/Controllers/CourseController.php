<?php

namespace App\Http\Controllers;

use App\Models\Course;

use App\Http\Requests\CourseRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    public function index()
    {
        try {
            $courses = Course::paginate(10);
            $metaData = Helper::getMetaData($courses);
            return Response::success(200, 'Course retrieved successfully', ['courses' => $courses->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $course = Course::find($id);
            if (!$course) {
                 return Response::notFound(404, 'Course not found');
            }
            return Response::success(200, 'Course retrieved successfully', ['course' => $course], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Course retrieval failed', 500);
        }
    }

    public function store(CourseRequest $request)
    {
        try {
            $course = Course::create($request->all());
            return Response::success(201, 'Course created successfully', ['course' => $course]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Course creation failed');
        }
    }

    public function update(CourseRequest $request, string $id)
    {
        try {
            $course = Course::find($id);
            if (!$course) {
                 return Response::notFound(404, 'Course not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $course->update($validatedData);
            return Response::success(200, 'Course updated successfully', ['course' => $course]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Course updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $course = Course::find($id);
            if (!$course) {
                return Response::notFound(404, 'Course not found');
            }

            $course->delete();
            return Response::success(200, 'Course deleted successfully', ['course' => $course]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Course deletion failed');
        }
    }
}
