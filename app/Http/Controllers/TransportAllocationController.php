<?php

namespace App\Http\Controllers;

use App\Models\TransportAllocation;

use App\Http\Requests\TransportAllocationRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class TransportAllocationController extends Controller
{
    public function index()
    {
        try {
            $transportAllocations = TransportAllocation::paginate(10);
            $metaData = Helper::getMetaData($transportAllocations);
            return Response::success(200, 'TransportAllocation retrieved successfully', ['transportAllocations' => $transportAllocations->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $transportAllocation = TransportAllocation::find($id);
            if (!$transportAllocation) {
                 return Response::notFound(404, 'TransportAllocation not found');
            }
            return Response::success(200, 'TransportAllocation retrieved successfully', ['transportAllocation' => $transportAllocation], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, TransportAllocation retrieval failed', 500);
        }
    }

    public function store(TransportAllocationRequest $request)
    {
        try {
            $transportAllocation = TransportAllocation::create($request->all());
            return Response::success(201, 'TransportAllocation created successfully', ['transportAllocation' => $transportAllocation]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, TransportAllocation creation failed');
        }
    }

    public function update(TransportAllocationRequest $request, string $id)
    {
        try {
            $transportAllocation = TransportAllocation::find($id);
            if (!$transportAllocation) {
                 return Response::notFound(404, 'TransportAllocation not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $transportAllocation->update($validatedData);
            return Response::success(200, 'TransportAllocation updated successfully', ['transportAllocation' => $transportAllocation]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, TransportAllocation updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $transportAllocation = TransportAllocation::find($id);
            if (!$transportAllocation) {
                return Response::notFound(404, 'TransportAllocation not found');
            }

            $transportAllocation->delete();
            return Response::success(200, 'TransportAllocation deleted successfully', ['transportAllocation' => $transportAllocation]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, TransportAllocation deletion failed');
        }
    }
}
