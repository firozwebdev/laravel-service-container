<?php

namespace App\Http\Controllers;

use App\Models\Grade;

use App\Http\Requests\GradeRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class GradeController extends Controller
{
    public function index()
    {
        try {
            $grades = Grade::paginate(10);
            $metaData = Helper::getMetaData($grades);
            return Response::success(200, 'Grade retrieved successfully', ['grades' => $grades->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $grade = Grade::find($id);
            if (!$grade) {
                 return Response::notFound(404, 'Grade not found');
            }
            return Response::success(200, 'Grade retrieved successfully', ['grade' => $grade], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Grade retrieval failed', 500);
        }
    }

    public function store(GradeRequest $request)
    {
        try {
            $grade = Grade::create($request->all());
            return Response::success(201, 'Grade created successfully', ['grade' => $grade]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Grade creation failed');
        }
    }

    public function update(GradeRequest $request, string $id)
    {
        try {
            $grade = Grade::find($id);
            if (!$grade) {
                 return Response::notFound(404, 'Grade not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $grade->update($validatedData);
            return Response::success(200, 'Grade updated successfully', ['grade' => $grade]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Grade updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $grade = Grade::find($id);
            if (!$grade) {
                return Response::notFound(404, 'Grade not found');
            }

            $grade->delete();
            return Response::success(200, 'Grade deleted successfully', ['grade' => $grade]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Grade deletion failed');
        }
    }
}
