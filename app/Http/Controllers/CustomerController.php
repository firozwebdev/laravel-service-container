<?php

namespace App\Http\Controllers;

use App\Models\Customer;

use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function index()
    {
        try {
            $customers = Customer::paginate(10);
            $metaData = Helper::getMetaData($customers);
            return view('customer.index', compact('customers'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(CustomerRequest $request)
    {
        try {
            $customer = Customer::create($request->all());
            return redirect()->route('customer.index')->with('success', 'Customer created successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Customer creation failed');
        }
    }

    public function show(string $id)
    {
        try {
            $customer = Customer::find($id);
            if (!$customer) {
                return Response::notFound(404, 'Customer not found');
            }
            return view('customer.show', compact('customer'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Customer retrieval failed', 500);
        }
    }
    
    public function edit(Customer $customer)
    {
        return view('customer.edit', compact('customer'));
    }

    public function update(CustomerRequest $request, string $id)
    {
        try {
            $customer = Customer::find($id);
            if (!$customer) {
                return Response::notFound(404, 'Customer not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed
            $customer->update($validatedData);
            return redirect()->route('customer.index')->with('success', 'Customer updated successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Customer updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $customer = Customer::find($id);
            if (!$customer) {
                return Response::notFound(404, 'Customer not found');
            }
            $customer->delete();
            return redirect()->route('customer.index')->with('success', 'Customer deleted successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Customer deletion failed');
        }
    }
}
