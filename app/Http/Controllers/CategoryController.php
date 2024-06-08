<?php

namespace App\Http\Controllers;

use App\Models\Category;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        $metaData  = Helper::getMetaData($categories);
        //return response()->json($categories);
        return Response::success(200, 'Category retrieved successfully', ['categories' => $categories->items()], $metaData);
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return Response::success(200, 'Category retrieved successfully', ['category' => $category],  $metaData = []);
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->all());
        return Response::success(201, 'Category  created successfully', ['category ' => $category ]);
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return Response::success(200, 'Category updated successfully', ['category' => $category]);
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return Response::success(200, 'Category deleted successfully', ['category' => $category]);
    }
}
