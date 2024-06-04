<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{{modelName}};

class PostController extends Controller
{
    public function index()
    {
        $data = {{modelName}}::all();
        return view('{{modelName}}.index', compact('data'));
    }

    public function create()
    {
        return view('{{modelName}}.create');
    }

    public function store(Request $request)
    {
        {{modelName}}::create($request->all());
        return redirect()->route('{{modelName}}.index');
    }

    public function show({{modelName}} ${{modelName}})
    {
        return view('{{modelName}}.show', compact('{{modelName}}'));
    }

    public function edit({{modelName}} ${{modelName}})
    {
        return view('{{modelName}}.edit', compact('{{modelName}}'));
    }

    public function update(Request $request, {{modelName}} ${{modelName}})
    {
        ${{modelName}}->update($request->all());
        return redirect()->route('{{modelName}}.index');
    }

    public function destroy({{modelName}} ${{modelName}})
    {
        ${{modelName}}->delete();
        return redirect()->route('{{modelName}}.index');
    }
}
