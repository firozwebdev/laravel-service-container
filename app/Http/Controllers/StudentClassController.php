<?php

namespace App\Http\Controllers;

use App\Models\StudentClass;

use App\Http\Requests\StudentClassRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class StudentClassController extends Controller
{
    public function index()
    {
        try {
            $studentClasses = StudentClass::paginate(10);
            $metaData = Helper::getMetaData($studentClasses);
            return Response::success(200, 'StudentClass retrieved successfully', ['studentClasses' => $studentClasses->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $studentClass = StudentClass::find($id);
            if (!$studentClass) {
                 return Response::notFound(404, 'StudentClass not found');
            }
            return Response::success(200, 'StudentClass retrieved successfully', ['studentClass' => $studentClass], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, StudentClass retrieval failed', 500);
        }
    }

    public function store(StudentClassRequest $request)
    {
        try {
            $studentClass = StudentClass::create($request->all());
            return Response::success(201, 'StudentClass created successfully', ['studentClass' => $studentClass]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, StudentClass creation failed');
        }
    }

    public function update(StudentClassRequest $request, string $id)
    {
        try {
            $studentClass = StudentClass::find($id);
            if (!$studentClass) {
                 return Response::notFound(404, 'StudentClass not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $studentClass->update($validatedData);
            return Response::success(200, 'StudentClass updated successfully', ['studentClass' => $studentClass]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, StudentClass updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $studentClass = StudentClass::find($id);
            if (!$studentClass) {
                return Response::notFound(404, 'StudentClass not found');
            }

            $studentClass->delete();
            return Response::success(200, 'StudentClass deleted successfully', ['studentClass' => $studentClass]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, StudentClass deletion failed');
        }
    }
}
