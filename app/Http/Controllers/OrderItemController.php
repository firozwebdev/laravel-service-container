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
            return view('orderItem.index', compact('orderItems'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function create()
    {
        return view('orderItem.create');
    }

    public function store(OrderItemRequest $request)
    {
        try {
            $orderItem = OrderItem::create($request->all());
            return redirect()->route('orderItem.index')->with('success', 'OrderItem created successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, OrderItem creation failed');
        }
    }

    public function show(string $id)
    {
        try {
            $orderItem = OrderItem::find($id);
            if (!$orderItem) {
                return Response::notFound(404, 'OrderItem not found');
            }
            return view('orderItem.show', compact('orderItem'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, OrderItem retrieval failed', 500);
        }
    }
    
    public function edit(OrderItem $orderItem)
    {
        return view('orderItem.edit', compact('orderItem'));
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
            return redirect()->route('orderItem.index')->with('success', 'OrderItem updated successfully.');
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
            return redirect()->route('orderItem.index')->with('success', 'OrderItem deleted successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, OrderItem deletion failed');
        }
    }
}
