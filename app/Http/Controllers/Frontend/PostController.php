<?php

namespace App\Http\Controllers\Frontend;

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
            return view('post.index', compact('posts'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(PostRequest $request)
    {
        try {
            $post = Post::create($request->all());
            return redirect()->route('post.index')->with('success', 'Post created successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Post creation failed');
        }
    }

    public function show(string $id)
    {
        try {
            $post = Post::find($id);
            if (!$post) {
                return Response::notFound(404, 'Post not found');
            }
            return view('post.show', compact('post'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Post retrieval failed', 500);
        }
    }
    
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
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
            return redirect()->route('post.index')->with('success', 'Post updated successfully.');
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
            return redirect()->route('post.index')->with('success', 'Post deleted successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Post deletion failed');
        }
    }
}
