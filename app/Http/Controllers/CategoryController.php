<?php

namespace App\Http\Controllers;

use App\Models\Category;

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
            return Response::success(200, 'Category retrieved successfully', ['categories' => $categories->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(Category $category)
    {
        try {
           
            if (!$category) {
                return Response::notFound('Sorry, Category not found!', 404);
            }
            return Response::success(200, 'Category retrieved successfully', ['category' => $category], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Category retrieval failed', 500);
        }
    }

    public function store(CategoryRequest $request)
    {
        try {
            $category = Category::create($request->all());
            return Response::success(201, 'Category created successfully', ['category' => $category]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Category creation failed');
        }
    }

    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $validatedData = $request->validated(); // Ensure validation is performed

            $category->update($validatedData);
            return Response::success(200, 'Category updated successfully', ['category' => $category]);
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
            return Response::success(200, 'Category deleted successfully', ['category' => $category]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Category deletion failed');
        }
    }
}
