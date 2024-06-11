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
            return view('assignment.index', compact('assignments'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function create()
    {
        return view('assignment.create');
    }

    public function store(AssignmentRequest $request)
    {
        try {
            $assignment = Assignment::create($request->all());
            return redirect()->route('assignment.index')->with('success', 'Assignment created successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Assignment creation failed');
        }
    }

    public function show(string $id)
    {
        try {
            $assignment = Assignment::find($id);
            if (!$assignment) {
                return Response::notFound(404, 'Assignment not found');
            }
            return view('assignment.show', compact('assignment'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Assignment retrieval failed', 500);
        }
    }
    
    public function edit(Assignment $assignment)
    {
        return view('assignment.edit', compact('assignment'));
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
            return redirect()->route('assignment.index')->with('success', 'Assignment updated successfully.');
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
            return redirect()->route('assignment.index')->with('success', 'Assignment deleted successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Assignment deletion failed');
        }
    }
}
