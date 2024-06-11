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
            return view('order.index', compact('orders'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function create()
    {
        return view('order.create');
    }

    public function store(OrderRequest $request)
    {
        try {
            $order = Order::create($request->all());
            return redirect()->route('order.index')->with('success', 'Order created successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Order creation failed');
        }
    }

    public function show(string $id)
    {
        try {
            $order = Order::find($id);
            if (!$order) {
                return Response::notFound(404, 'Order not found');
            }
            return view('order.show', compact('order'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Order retrieval failed', 500);
        }
    }
    
    public function edit(Order $order)
    {
        return view('order.edit', compact('order'));
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
            return redirect()->route('order.index')->with('success', 'Order updated successfully.');
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
            return redirect()->route('order.index')->with('success', 'Order deleted successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Order deletion failed');
        }
    }
}
