<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;

use App\Http\Requests\OrderItemRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class OrderItemController extends Controller
{
    public function index()
    {
        try {
            $orderItems = OrderItem::paginate(10);
            $metaData = Helper::getMetaData($orderItems);
            return Response::success(200, 'OrderItem retrieved successfully', ['orderItems' => $orderItems->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $orderItem = OrderItem::find($id);
            if (!$orderItem) {
                 return Response::notFound(404, 'OrderItem not found');
            }
            return Response::success(200, 'OrderItem retrieved successfully', ['orderItem' => $orderItem], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, OrderItem retrieval failed', 500);
        }
    }

    public function store(OrderItemRequest $request)
    {
        try {
            $orderItem = OrderItem::create($request->all());
            return Response::success(201, 'OrderItem created successfully', ['orderItem' => $orderItem]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, OrderItem creation failed');
        }
    }

    public function update(OrderItemRequest $request, string $id)
    {
        try {
            $orderItem = OrderItem::find($id);
            if (!$orderItem) {
                 return Response::notFound(404, 'OrderItem not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $orderItem->update($validatedData);
            return Response::success(200, 'OrderItem updated successfully', ['orderItem' => $orderItem]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, OrderItem updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $orderItem = OrderItem::find($id);
            if (!$orderItem) {
                return Response::notFound(404, 'OrderItem not found');
            }

            $orderItem->delete();
            return Response::success(200, 'OrderItem deleted successfully', ['orderItem' => $orderItem]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, OrderItem deletion failed');
        }
    }
}
