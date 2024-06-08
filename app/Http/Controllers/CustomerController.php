<?php

namespace App\Http\Controllers;

use App\Models\Customer;

use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(10);
        $metaData  = Helper::getMetaData($customers);
        //return response()->json($customers);
        return Response::success(200, 'Customer retrieved successfully', ['customers' => $customers->items()], $metaData);
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return Response::success(200, 'Customer retrieved successfully', ['customer' => $customer],  $metaData = []);
    }

    public function store(CustomerRequest $request)
    {
        $customer = Customer::create($request->all());
        return Response::success(201, 'Customer  created successfully', ['customer ' => $customer ]);
    }

    public function update(CustomerRequest $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        return Response::success(200, 'Customer updated successfully', ['customer' => $customer]);
    }

    public function destroy($id)
    {
        Customer::destroy($id);
        return Response::success(200, 'Customer deleted successfully', ['customer' => $customer]);
    }
}
