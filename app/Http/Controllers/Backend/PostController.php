<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index()
    {
        try {
            $posts = Post::paginate(10);
            $metaData = Helper::getMetaData($posts);
            return Response::success(200, 'Post retrieved successfully', ['posts' => $posts->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $post = Post::find($id);
            if (!$post) {
                 return Response::notFound(404, 'Post not found');
            }
            return Response::success(200, 'Post retrieved successfully', ['post' => $post], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Post retrieval failed', 500);
        }
    }

    public function store(PostRequest $request)
    {
        try {
            $post = Post::create($request->all());
            return Response::success(201, 'Post created successfully', ['post' => $post]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Post creation failed');
        }
    }

    public function update(PostRequest $request, string $id)
    {
        try {
            $post = Post::find($id);
            if (!$post) {
                 return Response::notFound(404, 'Post not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $post->update($validatedData);
            return Response::success(200, 'Post updated successfully', ['post' => $post]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Post updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $post = Post::find($id);
            if (!$post) {
                return Response::notFound(404, 'Post not found');
            }

            $post->delete();
            return Response::success(200, 'Post deleted successfully', ['post' => $post]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Post deletion failed');
        }
    }
}
