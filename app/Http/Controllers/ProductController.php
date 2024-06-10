<?php

namespace App\Http\Controllers;

use App\Models\Product;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::paginate(10);
            $metaData = Helper::getMetaData($products);
            return Response::success(200, 'Product retrieved successfully', ['products' => $products->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                 return Response::notFound(404, 'Product not found');
            }
            return Response::success(200, 'Product retrieved successfully', ['product' => $product], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Product retrieval failed', 500);
        }
    }

    public function store(ProductRequest $request)
    {
        try {
            $product = Product::create($request->all());
            return Response::success(201, 'Product created successfully', ['product' => $product]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Product creation failed');
        }
    }

    public function update(ProductRequest $request, string $id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                 return Response::notFound(404, 'Product not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $product->update($validatedData);
            return Response::success(200, 'Product updated successfully', ['product' => $product]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Product updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                return Response::notFound(404, 'Product not found');
            }

            $product->delete();
            return Response::success(200, 'Product deleted successfully', ['product' => $product]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Product deletion failed');
        }
    }
}
