<?php

namespace App\Http\Controllers;

use App\Models\Program;

use App\Http\Requests\ProgramRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class ProgramController extends Controller
{
    public function index()
    {
        try {
            $programs = Program::paginate(10);
            $metaData = Helper::getMetaData($programs);
            return Response::success(200, 'Program retrieved successfully', ['programs' => $programs->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $program = Program::find($id);
            if (!$program) {
                 return Response::notFound(404, 'Program not found');
            }
            return Response::success(200, 'Program retrieved successfully', ['program' => $program], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Program retrieval failed', 500);
        }
    }

    public function store(ProgramRequest $request)
    {
        try {
            $program = Program::create($request->all());
            return Response::success(201, 'Program created successfully', ['program' => $program]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Program creation failed');
        }
    }

    public function update(ProgramRequest $request, string $id)
    {
        try {
            $program = Program::find($id);
            if (!$program) {
                 return Response::notFound(404, 'Program not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $program->update($validatedData);
            return Response::success(200, 'Program updated successfully', ['program' => $program]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Program updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $program = Program::find($id);
            if (!$program) {
                return Response::notFound(404, 'Program not found');
            }

            $program->delete();
            return Response::success(200, 'Program deleted successfully', ['program' => $program]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Program deletion failed');
        }
    }
}
