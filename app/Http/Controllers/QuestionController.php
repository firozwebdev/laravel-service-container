<?php

namespace App\Http\Controllers;

use App\Models\Question;

use App\Http\Requests\QuestionRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    public function index()
    {
        try {
            $questions = Question::paginate(10);
            $metaData = Helper::getMetaData($questions);
            return Response::success(200, 'Question retrieved successfully', ['questions' => $questions->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $question = Question::find($id);
            if (!$question) {
                 return Response::notFound(404, 'Question not found');
            }
            return Response::success(200, 'Question retrieved successfully', ['question' => $question], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Question retrieval failed', 500);
        }
    }

    public function store(QuestionRequest $request)
    {
        try {
            $question = Question::create($request->all());
            return Response::success(201, 'Question created successfully', ['question' => $question]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Question creation failed');
        }
    }

    public function update(QuestionRequest $request, string $id)
    {
        try {
            $question = Question::find($id);
            if (!$question) {
                 return Response::notFound(404, 'Question not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $question->update($validatedData);
            return Response::success(200, 'Question updated successfully', ['question' => $question]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Question updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $question = Question::find($id);
            if (!$question) {
                return Response::notFound(404, 'Question not found');
            }

            $question->delete();
            return Response::success(200, 'Question deleted successfully', ['question' => $question]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Question deletion failed');
        }
    }
}
