<?php

namespace App\Http\Controllers;

use App\Models\Post;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);
        $metaData  = Helper::getMetaData($posts);
        //return response()->json($posts);
        return Response::success(200, 'Post retrieved successfully', ['posts' => $posts->items()], $metaData);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return Response::success(200, 'Post retrieved successfully', ['post' => $post],  $metaData = []);
    }

    public function store(PostRequest $request)
    {
        $post = Post::create($request->all());
        return Response::success(201, 'Post  created successfully', ['post ' => $post ]);
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return Response::success(200, 'Post updated successfully', ['post' => $post]);
    }

    public function destroy($id)
    {
        Post::destroy($id);
        return Response::success(200, 'Post deleted successfully', ['post' => $post]);
    }
}
