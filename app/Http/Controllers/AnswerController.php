<?php

namespace App\Http\Controllers;

use App\Models\Answer;

use App\Http\Requests\AnswerRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class AnswerController extends Controller
{
    public function index()
    {
        try {
            $answers = Answer::paginate(10);
            $metaData = Helper::getMetaData($answers);
            return Response::success(200, 'Answer retrieved successfully', ['answers' => $answers->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $answer = Answer::find($id);
            if (!$answer) {
                 return Response::notFound(404, 'Answer not found');
            }
            return Response::success(200, 'Answer retrieved successfully', ['answer' => $answer], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Answer retrieval failed', 500);
        }
    }

    public function store(AnswerRequest $request)
    {
        try {
            $answer = Answer::create($request->all());
            return Response::success(201, 'Answer created successfully', ['answer' => $answer]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Answer creation failed');
        }
    }

    public function update(AnswerRequest $request, string $id)
    {
        try {
            $answer = Answer::find($id);
            if (!$answer) {
                 return Response::notFound(404, 'Answer not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $answer->update($validatedData);
            return Response::success(200, 'Answer updated successfully', ['answer' => $answer]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Answer updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $answer = Answer::find($id);
            if (!$answer) {
                return Response::notFound(404, 'Answer not found');
            }

            $answer->delete();
            return Response::success(200, 'Answer deleted successfully', ['answer' => $answer]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Answer deletion failed');
        }
    }
}
