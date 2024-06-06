<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\ResponseUtility;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        //return response()->json($categories);
        return ResponseUtility::success(200, 'categories retrieved successfully', ['categories' => $categories->items()], $metaData);
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
         return ResponseUtility::success(200, 'category retrieved successfully', ['category' => $category],  $metaData = []);
    }

    public function store(Request $request)
    {
        $category = Category::create($request->all());
        return ResponseUtility::success(201, 'category  created successfully', ['category ' => $category ]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return ResponseUtility::success(200, 'category updated successfully', ['category' => $category]);
    }

    public function destroy($id)
    {
        Category::destroy($id);
         return ResponseUtility::success(200, 'Category deleted successfully', ['Category' => $Category]);
    }
}
