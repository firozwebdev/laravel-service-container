<?php

namespace App\Http\Controllers;

use App\Models\Student;

use App\Http\Requests\StudentRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    public function index()
    {
        try {
            $students = Student::paginate(10);
            $metaData = Helper::getMetaData($students);
            return Response::success(200, 'Student retrieved successfully', ['students' => $students->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $student = Student::find($id);
            if (!$student) {
                 return Response::notFound(404, 'Student not found');
            }
            return Response::success(200, 'Student retrieved successfully', ['student' => $student], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Student retrieval failed', 500);
        }
    }

    public function store(StudentRequest $request)
    {
        try {
            $student = Student::create($request->all());
            return Response::success(201, 'Student created successfully', ['student' => $student]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Student creation failed');
        }
    }

    public function update(StudentRequest $request, string $id)
    {
        try {
            $student = Student::find($id);
            if (!$student) {
                 return Response::notFound(404, 'Student not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $student->update($validatedData);
            return Response::success(200, 'Student updated successfully', ['student' => $student]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Student updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $student = Student::find($id);
            if (!$student) {
                return Response::notFound(404, 'Student not found');
            }

            $student->delete();
            return Response::success(200, 'Student deleted successfully', ['student' => $student]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Student deletion failed');
        }
    }
}
