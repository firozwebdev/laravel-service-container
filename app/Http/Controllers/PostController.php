<?php

namespace App\Http\Controllers;

use App\Models\Post;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\ResponseUtility;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        //return response()->json($posts);
        return ResponseUtility::success(200, 'Post retrieved successfully', ['posts' => $posts->items()], $metaData);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return ResponseUtility::success(200, 'Post retrieved successfully', ['post' => $post],  $metaData = []);
    }

    public function store(PostRequest $request)
    {
        $post = Post::create($request->all());
        return ResponseUtility::success(201, 'Post  created successfully', ['post ' => $post ]);
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return ResponseUtility::success(200, 'Post updated successfully', ['post' => $post]);
    }

    public function destroy($id)
    {
        Post::destroy($id);
        return ResponseUtility::success(200, 'Post deleted successfully', ['post' => $post]);
    }
}
