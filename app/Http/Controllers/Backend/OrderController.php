<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        try {
            $orders = Order::paginate(10);
            $metaData = Helper::getMetaData($orders);
            return Response::success(200, 'Order retrieved successfully', ['orders' => $orders->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $order = Order::find($id);
            if (!$order) {
                 return Response::notFound(404, 'Order not found');
            }
            return Response::success(200, 'Order retrieved successfully', ['order' => $order], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Order retrieval failed', 500);
        }
    }

    public function store(OrderRequest $request)
    {
        try {
            $order = Order::create($request->all());
            return Response::success(201, 'Order created successfully', ['order' => $order]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Order creation failed');
        }
    }

    public function update(OrderRequest $request, string $id)
    {
        try {
            $order = Order::find($id);
            if (!$order) {
                 return Response::notFound(404, 'Order not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $order->update($validatedData);
            return Response::success(200, 'Order updated successfully', ['order' => $order]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Order updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $order = Order::find($id);
            if (!$order) {
                return Response::notFound(404, 'Order not found');
            }

            $order->delete();
            return Response::success(200, 'Order deleted successfully', ['order' => $order]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Order deletion failed');
        }
    }
}
