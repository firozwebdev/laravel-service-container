<?php

namespace App\Http\Controllers;

use App\Models\Faculty;

use App\Http\Requests\FacultyRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class FacultyController extends Controller
{
    public function index()
    {
        try {
            $faculties = Faculty::paginate(10);
            $metaData = Helper::getMetaData($faculties);
            return Response::success(200, 'Faculty retrieved successfully', ['faculties' => $faculties->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $faculty = Faculty::find($id);
            if (!$faculty) {
                 return Response::notFound(404, 'Faculty not found');
            }
            return Response::success(200, 'Faculty retrieved successfully', ['faculty' => $faculty], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Faculty retrieval failed', 500);
        }
    }

    public function store(FacultyRequest $request)
    {
        try {
            $faculty = Faculty::create($request->all());
            return Response::success(201, 'Faculty created successfully', ['faculty' => $faculty]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Faculty creation failed');
        }
    }

    public function update(FacultyRequest $request, string $id)
    {
        try {
            $faculty = Faculty::find($id);
            if (!$faculty) {
                 return Response::notFound(404, 'Faculty not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $faculty->update($validatedData);
            return Response::success(200, 'Faculty updated successfully', ['faculty' => $faculty]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Faculty updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $faculty = Faculty::find($id);
            if (!$faculty) {
                return Response::notFound(404, 'Faculty not found');
            }

            $faculty->delete();
            return Response::success(200, 'Faculty deleted successfully', ['faculty' => $faculty]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Faculty deletion failed');
        }
    }
}
