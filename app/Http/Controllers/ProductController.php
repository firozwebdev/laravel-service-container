<?php

namespace App\Http\Controllers;

use App\Models\Product;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\ResponseUtility;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        //return response()->json($products);
        return ResponseUtility::success(200, 'Product retrieved successfully', ['products' => $products->items()], $metaData);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return ResponseUtility::success(200, 'Product retrieved successfully', ['product' => $product],  $metaData = []);
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->all());
        return ResponseUtility::success(201, 'Product  created successfully', ['product ' => $product ]);
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return ResponseUtility::success(200, 'Product updated successfully', ['product' => $product]);
    }

    public function destroy($id)
    {
        Product::destroy($id);
        return ResponseUtility::success(200, 'Product deleted successfully', ['product' => $product]);
    }
}
