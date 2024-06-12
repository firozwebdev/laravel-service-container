<?php

namespace App\Http\Controllers;

use App\Models\HostelAllocation;

use App\Http\Requests\HostelAllocationRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class HostelAllocationController extends Controller
{
    public function index()
    {
        try {
            $hostelAllocations = HostelAllocation::paginate(10);
            $metaData = Helper::getMetaData($hostelAllocations);
            return Response::success(200, 'HostelAllocation retrieved successfully', ['hostelAllocations' => $hostelAllocations->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $hostelAllocation = HostelAllocation::find($id);
            if (!$hostelAllocation) {
                 return Response::notFound(404, 'HostelAllocation not found');
            }
            return Response::success(200, 'HostelAllocation retrieved successfully', ['hostelAllocation' => $hostelAllocation], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, HostelAllocation retrieval failed', 500);
        }
    }

    public function store(HostelAllocationRequest $request)
    {
        try {
            $hostelAllocation = HostelAllocation::create($request->all());
            return Response::success(201, 'HostelAllocation created successfully', ['hostelAllocation' => $hostelAllocation]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, HostelAllocation creation failed');
        }
    }

    public function update(HostelAllocationRequest $request, string $id)
    {
        try {
            $hostelAllocation = HostelAllocation::find($id);
            if (!$hostelAllocation) {
                 return Response::notFound(404, 'HostelAllocation not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $hostelAllocation->update($validatedData);
            return Response::success(200, 'HostelAllocation updated successfully', ['hostelAllocation' => $hostelAllocation]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, HostelAllocation updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $hostelAllocation = HostelAllocation::find($id);
            if (!$hostelAllocation) {
                return Response::notFound(404, 'HostelAllocation not found');
            }

            $hostelAllocation->delete();
            return Response::success(200, 'HostelAllocation deleted successfully', ['hostelAllocation' => $hostelAllocation]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, HostelAllocation deletion failed');
        }
    }
}
