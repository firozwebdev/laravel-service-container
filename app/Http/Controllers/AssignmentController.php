<?php

namespace App\Http\Controllers;

use App\Models\Assignment;

use App\Http\Requests\AssignmentRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class AssignmentController extends Controller
{
    public function index()
    {
        try {
            $assignments = Assignment::paginate(10);
            $metaData = Helper::getMetaData($assignments);
            return Response::success(200, 'Assignment retrieved successfully', ['assignments' => $assignments->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $assignment = Assignment::find($id);
            if (!$assignment) {
                 return Response::notFound(404, 'Assignment not found');
            }
            return Response::success(200, 'Assignment retrieved successfully', ['assignment' => $assignment], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Assignment retrieval failed', 500);
        }
    }

    public function store(AssignmentRequest $request)
    {
        try {
            $assignment = Assignment::create($request->all());
            return Response::success(201, 'Assignment created successfully', ['assignment' => $assignment]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Assignment creation failed');
        }
    }

    public function update(AssignmentRequest $request, string $id)
    {
        try {
            $assignment = Assignment::find($id);
            if (!$assignment) {
                 return Response::notFound(404, 'Assignment not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $assignment->update($validatedData);
            return Response::success(200, 'Assignment updated successfully', ['assignment' => $assignment]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Assignment updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $assignment = Assignment::find($id);
            if (!$assignment) {
                return Response::notFound(404, 'Assignment not found');
            }

            $assignment->delete();
            return Response::success(200, 'Assignment deleted successfully', ['assignment' => $assignment]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Assignment deletion failed');
        }
    }
}
