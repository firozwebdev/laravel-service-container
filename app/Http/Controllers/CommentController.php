<?php

namespace App\Http\Controllers;

use App\Models\Comment;

use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function index()
    {
        try {
            $comments = Comment::paginate(10);
            $metaData = Helper::getMetaData($comments);
            return Response::success(200, 'Comment retrieved successfully', ['comments' => $comments->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $comment = Comment::find($id);
            if (!$comment) {
                 return Response::notFound(404, 'Comment not found');
            }
            return Response::success(200, 'Comment retrieved successfully', ['comment' => $comment], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Comment retrieval failed', 500);
        }
    }

    public function store(CommentRequest $request)
    {
        try {
            $comment = Comment::create($request->all());
            return Response::success(201, 'Comment created successfully', ['comment' => $comment]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Comment creation failed');
        }
    }

    public function update(CommentRequest $request, string $id)
    {
        try {
            $comment = Comment::find($id);
            if (!$comment) {
                 return Response::notFound(404, 'Comment not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $comment->update($validatedData);
            return Response::success(200, 'Comment updated successfully', ['comment' => $comment]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Comment updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $comment = Comment::find($id);
            if (!$comment) {
                return Response::notFound(404, 'Comment not found');
            }

            $comment->delete();
            return Response::success(200, 'Comment deleted successfully', ['comment' => $comment]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Comment deletion failed');
        }
    }
}
