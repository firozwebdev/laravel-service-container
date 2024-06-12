<?php

namespace App\Http\Controllers;

use App\Models\Payment;

use App\Http\Requests\PaymentRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function index()
    {
        try {
            $payments = Payment::paginate(10);
            $metaData = Helper::getMetaData($payments);
            return Response::success(200, 'Payment retrieved successfully', ['payments' => $payments->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $payment = Payment::find($id);
            if (!$payment) {
                 return Response::notFound(404, 'Payment not found');
            }
            return Response::success(200, 'Payment retrieved successfully', ['payment' => $payment], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Payment retrieval failed', 500);
        }
    }

    public function store(PaymentRequest $request)
    {
        try {
            $payment = Payment::create($request->all());
            return Response::success(201, 'Payment created successfully', ['payment' => $payment]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Payment creation failed');
        }
    }

    public function update(PaymentRequest $request, string $id)
    {
        try {
            $payment = Payment::find($id);
            if (!$payment) {
                 return Response::notFound(404, 'Payment not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $payment->update($validatedData);
            return Response::success(200, 'Payment updated successfully', ['payment' => $payment]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Payment updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $payment = Payment::find($id);
            if (!$payment) {
                return Response::notFound(404, 'Payment not found');
            }

            $payment->delete();
            return Response::success(200, 'Payment deleted successfully', ['payment' => $payment]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Payment deletion failed');
        }
    }
}
