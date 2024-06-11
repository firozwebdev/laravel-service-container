<?php

namespace App\Http\Controllers;

use App\Models\AssetPurchaseOrder;

use App\Http\Requests\AssetPurchaseOrderRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class AssetPurchaseOrderController extends Controller
{
    public function index()
    {
        try {
            $assetPurchaseOrders = AssetPurchaseOrder::paginate(10);
            $metaData = Helper::getMetaData($assetPurchaseOrders);
            return Response::success(200, 'AssetPurchaseOrder retrieved successfully', ['assetPurchaseOrders' => $assetPurchaseOrders->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $assetPurchaseOrder = AssetPurchaseOrder::find($id);
            if (!$assetPurchaseOrder) {
                 return Response::notFound(404, 'AssetPurchaseOrder not found');
            }
            return Response::success(200, 'AssetPurchaseOrder retrieved successfully', ['assetPurchaseOrder' => $assetPurchaseOrder], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, AssetPurchaseOrder retrieval failed', 500);
        }
    }

    public function store(AssetPurchaseOrderRequest $request)
    {
        try {
            $assetPurchaseOrder = AssetPurchaseOrder::create($request->all());
            return Response::success(201, 'AssetPurchaseOrder created successfully', ['assetPurchaseOrder' => $assetPurchaseOrder]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, AssetPurchaseOrder creation failed');
        }
    }

    public function update(AssetPurchaseOrderRequest $request, string $id)
    {
        try {
            $assetPurchaseOrder = AssetPurchaseOrder::find($id);
            if (!$assetPurchaseOrder) {
                 return Response::notFound(404, 'AssetPurchaseOrder not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $assetPurchaseOrder->update($validatedData);
            return Response::success(200, 'AssetPurchaseOrder updated successfully', ['assetPurchaseOrder' => $assetPurchaseOrder]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, AssetPurchaseOrder updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $assetPurchaseOrder = AssetPurchaseOrder::find($id);
            if (!$assetPurchaseOrder) {
                return Response::notFound(404, 'AssetPurchaseOrder not found');
            }

            $assetPurchaseOrder->delete();
            return Response::success(200, 'AssetPurchaseOrder deleted successfully', ['assetPurchaseOrder' => $assetPurchaseOrder]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, AssetPurchaseOrder deletion failed');
        }
    }
}
