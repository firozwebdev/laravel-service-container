<?php

namespace App\Http\Controllers\Backedn;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\ResponseUtility;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        //return response()->json($categories);
        return ResponseUtility::success(200, 'Category retrieved successfully', ['categories' => $categories->items()], $metaData);
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return ResponseUtility::success(200, 'Category retrieved successfully', ['category' => $category],  $metaData = []);
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->all());
        return ResponseUtility::success(201, 'Category  created successfully', ['category ' => $category ]);
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return ResponseUtility::success(200, 'Category updated successfully', ['category' => $category]);
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return ResponseUtility::success(200, 'Category deleted successfully', ['category' => $category]);
    }
}
