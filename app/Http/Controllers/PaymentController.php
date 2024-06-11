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
            return view('payment.index', compact('payments'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function create()
    {
        return view('payment.create');
    }

    public function store(PaymentRequest $request)
    {
        try {
            $payment = Payment::create($request->all());
            return redirect()->route('payment.index')->with('success', 'Payment created successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Payment creation failed');
        }
    }

    public function show(string $id)
    {
        try {
            $payment = Payment::find($id);
            if (!$payment) {
                return Response::notFound(404, 'Payment not found');
            }
            return view('payment.show', compact('payment'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Payment retrieval failed', 500);
        }
    }
    
    public function edit(Payment $payment)
    {
        return view('payment.edit', compact('payment'));
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
            return redirect()->route('payment.index')->with('success', 'Payment updated successfully.');
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
            return redirect()->route('payment.index')->with('success', 'Payment deleted successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Payment deletion failed');
        }
    }
}
