<?php

namespace App\Http\Controllers;

use App\Models\Payment;

use App\Http\Requests\PaymentRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::paginate(10);
        $metaData  = Helper::getMetaData($payments);
        //return response()->json($payments);
        return Response::success(200, 'Payment retrieved successfully', ['payments' => $payments->items()], $metaData);
    }

    public function show($id)
    {
        $payment = Payment::findOrFail($id);
        return Response::success(200, 'Payment retrieved successfully', ['payment' => $payment],  $metaData = []);
    }

    public function store(PaymentRequest $request)
    {
        $payment = Payment::create($request->all());
        return Response::success(201, 'Payment  created successfully', ['payment ' => $payment ]);
    }

    public function update(PaymentRequest $request, $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->update($request->all());
        return Response::success(200, 'Payment updated successfully', ['payment' => $payment]);
    }

    public function destroy($id)
    {
        Payment::destroy($id);
        return Response::success(200, 'Payment deleted successfully', ['payment' => $payment]);
    }
}
