<?php

namespace App\Http\Controllers\Backend;

use App\Models\Supplier;
use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class SupplierController extends Controller
{
    public function index()
    {
        try {
            $suppliers = Supplier::paginate(10);
            $metaData = Helper::getMetaData($suppliers);
            return Response::success(200, 'Supplier retrieved successfully', ['suppliers' => $suppliers->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $supplier = Supplier::find($id);
            if (!$supplier) {
                 return Response::notFound(404, 'Supplier not found');
            }
            return Response::success(200, 'Supplier retrieved successfully', ['supplier' => $supplier], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Supplier retrieval failed', 500);
        }
    }

    public function store(SupplierRequest $request)
    {
        try {
            $supplier = Supplier::create($request->all());
            return Response::success(201, 'Supplier created successfully', ['supplier' => $supplier]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Supplier creation failed');
        }
    }

    public function update(SupplierRequest $request, string $id)
    {
        try {
            $supplier = Supplier::find($id);
            if (!$supplier) {
                 return Response::notFound(404, 'Supplier not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $supplier->update($validatedData);
            return Response::success(200, 'Supplier updated successfully', ['supplier' => $supplier]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Supplier updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $supplier = Supplier::find($id);
            if (!$supplier) {
                return Response::notFound(404, 'Supplier not found');
            }

            $supplier->delete();
            return Response::success(200, 'Supplier deleted successfully', ['supplier' => $supplier]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Supplier deletion failed');
        }
    }
}
