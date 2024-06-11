<?php

namespace App\Http\Controllers;

use App\Models\Paymnet;

use App\Http\Requests\PaymnetRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class PaymnetController extends Controller
{
    public function index()
    {
        try {
            $paymnets = Paymnet::paginate(10);
            $metaData = Helper::getMetaData($paymnets);
            return view('paymnet.index', compact('paymnets'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function create()
    {
        return view('paymnet.create');
    }

    public function store(PaymnetRequest $request)
    {
        try {
            $paymnet = Paymnet::create($request->all());
            return redirect()->route('paymnet.index')->with('success', 'Paymnet created successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Paymnet creation failed');
        }
    }

    public function show(string $id)
    {
        try {
            $paymnet = Paymnet::find($id);
            if (!$paymnet) {
                return Response::notFound(404, 'Paymnet not found');
            }
            return view('paymnet.show', compact('paymnet'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Paymnet retrieval failed', 500);
        }
    }
    
    public function edit(Paymnet $paymnet)
    {
        return view('paymnet.edit', compact('paymnet'));
    }

    public function update(PaymnetRequest $request, string $id)
    {
        try {
            $paymnet = Paymnet::find($id);
            if (!$paymnet) {
                return Response::notFound(404, 'Paymnet not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed
            $paymnet->update($validatedData);
            return redirect()->route('paymnet.index')->with('success', 'Paymnet updated successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Paymnet updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $paymnet = Paymnet::find($id);
            if (!$paymnet) {
                return Response::notFound(404, 'Paymnet not found');
            }
            $paymnet->delete();
            return redirect()->route('paymnet.index')->with('success', 'Paymnet deleted successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Paymnet deletion failed');
        }
    }
}
