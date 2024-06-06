<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\ResponseUtility;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        //return response()->json($orders);
        return ResponseUtility::success(200, 'Order retrieved successfully', ['orders' => $orders->items()], $metaData);
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return ResponseUtility::success(200, 'Order retrieved successfully', ['order' => $order],  $metaData = []);
    }

    public function store(OrderRequest $request)
    {
        $order = Order::create($request->all());
        return ResponseUtility::success(201, 'Order  created successfully', ['order ' => $order ]);
    }

    public function update(OrderRequest $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());
        return ResponseUtility::success(200, 'Order updated successfully', ['order' => $order]);
    }

    public function destroy($id)
    {
        Order::destroy($id);
        return ResponseUtility::success(200, 'Order deleted successfully', ['order' => $order]);
    }
    
    public function test($id)
    {
        Order::destroy($id);
        return ResponseUtility::success(200, 'Order deleted successfully', ['order' => $order]);
    }
}
