<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::all();
        return view('Product.index', compact('data'));
    }

    public function create()
    {
        return view('Product.create');
    }

    public function store(Request $request)
    {
        Product::create($request->all());
        return redirect()->route('Product.index');
    }

    public function show(Product $Product)
    {
        return view('Product.show', compact('Product'));
    }

    public function edit(Product $Product)
    {
        return view('Product.edit', compact('Product'));
    }

    public function update(Request $request, Product $Product)
    {
        $Product->update($request->all());
        return redirect()->route('Product.index');
    }

    public function destroy(Product $Product)
    {
        $Product->delete();
        return redirect()->route('Product.index');
    }
}
