<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrderItem;

use App\Http\Requests\PurchaseOrderItemRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class PurchaseOrderItemController extends Controller
{
    public function index()
    {
        try {
            $purchaseOrderItems = PurchaseOrderItem::paginate(10);
            $metaData = Helper::getMetaData($purchaseOrderItems);
            return Response::success(200, 'PurchaseOrderItem retrieved successfully', ['purchaseOrderItems' => $purchaseOrderItems->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $purchaseOrderItem = PurchaseOrderItem::find($id);
            if (!$purchaseOrderItem) {
                 return Response::notFound(404, 'PurchaseOrderItem not found');
            }
            return Response::success(200, 'PurchaseOrderItem retrieved successfully', ['purchaseOrderItem' => $purchaseOrderItem], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, PurchaseOrderItem retrieval failed', 500);
        }
    }

    public function store(PurchaseOrderItemRequest $request)
    {
        try {
            $purchaseOrderItem = PurchaseOrderItem::create($request->all());
            return Response::success(201, 'PurchaseOrderItem created successfully', ['purchaseOrderItem' => $purchaseOrderItem]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, PurchaseOrderItem creation failed');
        }
    }

    public function update(PurchaseOrderItemRequest $request, string $id)
    {
        try {
            $purchaseOrderItem = PurchaseOrderItem::find($id);
            if (!$purchaseOrderItem) {
                 return Response::notFound(404, 'PurchaseOrderItem not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $purchaseOrderItem->update($validatedData);
            return Response::success(200, 'PurchaseOrderItem updated successfully', ['purchaseOrderItem' => $purchaseOrderItem]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, PurchaseOrderItem updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $purchaseOrderItem = PurchaseOrderItem::find($id);
            if (!$purchaseOrderItem) {
                return Response::notFound(404, 'PurchaseOrderItem not found');
            }

            $purchaseOrderItem->delete();
            return Response::success(200, 'PurchaseOrderItem deleted successfully', ['purchaseOrderItem' => $purchaseOrderItem]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, PurchaseOrderItem deletion failed');
        }
    }
}
