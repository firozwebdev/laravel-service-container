<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::paginate(10);
            $metaData = Helper::getMetaData($categories);
            return view('category.index', compact('categories'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(CategoryRequest $request)
    {
        try {
            $category = Category::create($request->all());
            return redirect()->route('category.index')->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Category creation failed');
        }
    }

    public function show(string $id)
    {
        try {
            $category = Category::find($id);
            if (!$category) {
                return Response::notFound(404, 'Category not found');
            }
            return view('category.show', compact('category'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Category retrieval failed', 500);
        }
    }
    
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, string $id)
    {
        try {
            $category = Category::find($id);
            if (!$category) {
                return Response::notFound(404, 'Category not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed
            $category->update($validatedData);
            return redirect()->route('category.index')->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Category updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $category = Category::find($id);
            if (!$category) {
                return Response::notFound(404, 'Category not found');
            }
            $category->delete();
            return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Category deletion failed');
        }
    }
}
