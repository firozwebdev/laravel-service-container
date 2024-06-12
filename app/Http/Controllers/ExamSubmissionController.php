<?php

namespace App\Http\Controllers;

use App\Models\ExamSubmission;

use App\Http\Requests\ExamSubmissionRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class ExamSubmissionController extends Controller
{
    public function index()
    {
        try {
            $examSubmissions = ExamSubmission::paginate(10);
            $metaData = Helper::getMetaData($examSubmissions);
            return Response::success(200, 'ExamSubmission retrieved successfully', ['examSubmissions' => $examSubmissions->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $examSubmission = ExamSubmission::find($id);
            if (!$examSubmission) {
                 return Response::notFound(404, 'ExamSubmission not found');
            }
            return Response::success(200, 'ExamSubmission retrieved successfully', ['examSubmission' => $examSubmission], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, ExamSubmission retrieval failed', 500);
        }
    }

    public function store(ExamSubmissionRequest $request)
    {
        try {
            $examSubmission = ExamSubmission::create($request->all());
            return Response::success(201, 'ExamSubmission created successfully', ['examSubmission' => $examSubmission]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, ExamSubmission creation failed');
        }
    }

    public function update(ExamSubmissionRequest $request, string $id)
    {
        try {
            $examSubmission = ExamSubmission::find($id);
            if (!$examSubmission) {
                 return Response::notFound(404, 'ExamSubmission not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $examSubmission->update($validatedData);
            return Response::success(200, 'ExamSubmission updated successfully', ['examSubmission' => $examSubmission]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, ExamSubmission updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $examSubmission = ExamSubmission::find($id);
            if (!$examSubmission) {
                return Response::notFound(404, 'ExamSubmission not found');
            }

            $examSubmission->delete();
            return Response::success(200, 'ExamSubmission deleted successfully', ['examSubmission' => $examSubmission]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, ExamSubmission deletion failed');
        }
    }
}
