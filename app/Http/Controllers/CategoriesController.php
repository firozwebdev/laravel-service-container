<?php

namespace App\Http\Controllers;

use App\Models\Categories;

use App\Http\Requests\CategoriesRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class CategoriesController extends Controller
{
    public function index()
    {
        try {
            $categories = Categories::paginate(10);
            $metaData = Helper::getMetaData($categories);
            return Response::success(200, 'Categories retrieved successfully', ['categories' => $categories->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $category = Categories::find($id);
            if (!$category) {
                 return Response::notFound(404, 'Categories not found');
            }
            return Response::success(200, 'Categories retrieved successfully', ['category' => $category], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Categories retrieval failed', 500);
        }
    }

    public function store(CategoriesRequest $request)
    {
        try {
            $category = Categories::create($request->all());
            return Response::success(201, 'Categories created successfully', ['category' => $category]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Categories creation failed');
        }
    }

    public function update(CategoriesRequest $request, string $id)
    {
        try {
            $category = Categories::find($id);
            if (!$category) {
                 return Response::notFound(404, 'Categories not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $category->update($validatedData);
            return Response::success(200, 'Categories updated successfully', ['category' => $category]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Categories updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $category = Categories::find($id);
            if (!$category) {
                return Response::notFound(404, 'Categories not found');
            }

            $category->delete();
            return Response::success(200, 'Categories deleted successfully', ['category' => $category]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Categories deletion failed');
        }
    }
}
