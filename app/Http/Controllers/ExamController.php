<?php

namespace App\Http\Controllers;

use App\Models\Exam;

use App\Http\Requests\ExamRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class ExamController extends Controller
{
    public function index()
    {
        try {
            $exams = Exam::paginate(10);
            $metaData = Helper::getMetaData($exams);
            return Response::success(200, 'Exam retrieved successfully', ['exams' => $exams->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $exam = Exam::find($id);
            if (!$exam) {
                 return Response::notFound(404, 'Exam not found');
            }
            return Response::success(200, 'Exam retrieved successfully', ['exam' => $exam], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Exam retrieval failed', 500);
        }
    }

    public function store(ExamRequest $request)
    {
        try {
            $exam = Exam::create($request->all());
            return Response::success(201, 'Exam created successfully', ['exam' => $exam]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Exam creation failed');
        }
    }

    public function update(ExamRequest $request, string $id)
    {
        try {
            $exam = Exam::find($id);
            if (!$exam) {
                 return Response::notFound(404, 'Exam not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $exam->update($validatedData);
            return Response::success(200, 'Exam updated successfully', ['exam' => $exam]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Exam updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $exam = Exam::find($id);
            if (!$exam) {
                return Response::notFound(404, 'Exam not found');
            }

            $exam->delete();
            return Response::success(200, 'Exam deleted successfully', ['exam' => $exam]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Exam deletion failed');
        }
    }
}
