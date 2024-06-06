<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\ResponseUtility;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        //return response()->json($posts);
        return ResponseUtility::success(200, 'posts retrieved successfully', ['posts' => $posts->items()], $metaData);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
         return ResponseUtility::success(200, 'post retrieved successfully', ['post' => $post],  $metaData = []);
    }

    public function store(Request $request)
    {
        $post = Post::create($request->all());
        return ResponseUtility::success(201, 'post  created successfully', ['post ' => $post ]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return ResponseUtility::success(200, 'post updated successfully', ['post' => $post]);
    }

    public function destroy($id)
    {
        Post::destroy($id);
         return ResponseUtility::success(200, 'Post deleted successfully', ['Post' => $Post]);
    }
}
