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
            return view('student.index', compact('students'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function create()
    {
        return view('student.create');
    }

    public function store(StudentRequest $request)
    {
        try {
            $student = Student::create($request->all());
            return redirect()->route('student.index')->with('success', 'Student created successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Student creation failed');
        }
    }

    public function show(string $id)
    {
        try {
            $student = Student::find($id);
            if (!$student) {
                return Response::notFound(404, 'Student not found');
            }
            return view('student.show', compact('student'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Student retrieval failed', 500);
        }
    }
    
    public function edit(Student $student)
    {
        return view('student.edit', compact('student'));
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
            return redirect()->route('student.index')->with('success', 'Student updated successfully.');
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
            return redirect()->route('student.index')->with('success', 'Student deleted successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Student deletion failed');
        }
    }
}
