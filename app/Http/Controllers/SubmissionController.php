<?php

namespace App\Http\Controllers;

use App\Models\Submission;

use App\Http\Requests\SubmissionRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class SubmissionController extends Controller
{
    public function index()
    {
        try {
            $submissions = Submission::paginate(10);
            $metaData = Helper::getMetaData($submissions);
            return Response::success(200, 'Submission retrieved successfully', ['submissions' => $submissions->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $submission = Submission::find($id);
            if (!$submission) {
                 return Response::notFound(404, 'Submission not found');
            }
            return Response::success(200, 'Submission retrieved successfully', ['submission' => $submission], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Submission retrieval failed', 500);
        }
    }

    public function store(SubmissionRequest $request)
    {
        try {
            $submission = Submission::create($request->all());
            return Response::success(201, 'Submission created successfully', ['submission' => $submission]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Submission creation failed');
        }
    }

    public function update(SubmissionRequest $request, string $id)
    {
        try {
            $submission = Submission::find($id);
            if (!$submission) {
                 return Response::notFound(404, 'Submission not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $submission->update($validatedData);
            return Response::success(200, 'Submission updated successfully', ['submission' => $submission]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Submission updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $submission = Submission::find($id);
            if (!$submission) {
                return Response::notFound(404, 'Submission not found');
            }

            $submission->delete();
            return Response::success(200, 'Submission deleted successfully', ['submission' => $submission]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Submission deletion failed');
        }
    }
}
