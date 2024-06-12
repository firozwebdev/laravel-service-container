<?php

namespace App\Http\Controllers;

use App\Models\Transport;

use App\Http\Requests\TransportRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class TransportController extends Controller
{
    public function index()
    {
        try {
            $transports = Transport::paginate(10);
            $metaData = Helper::getMetaData($transports);
            return Response::success(200, 'Transport retrieved successfully', ['transports' => $transports->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $transport = Transport::find($id);
            if (!$transport) {
                 return Response::notFound(404, 'Transport not found');
            }
            return Response::success(200, 'Transport retrieved successfully', ['transport' => $transport], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Transport retrieval failed', 500);
        }
    }

    public function store(TransportRequest $request)
    {
        try {
            $transport = Transport::create($request->all());
            return Response::success(201, 'Transport created successfully', ['transport' => $transport]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Transport creation failed');
        }
    }

    public function update(TransportRequest $request, string $id)
    {
        try {
            $transport = Transport::find($id);
            if (!$transport) {
                 return Response::notFound(404, 'Transport not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $transport->update($validatedData);
            return Response::success(200, 'Transport updated successfully', ['transport' => $transport]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Transport updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $transport = Transport::find($id);
            if (!$transport) {
                return Response::notFound(404, 'Transport not found');
            }

            $transport->delete();
            return Response::success(200, 'Transport deleted successfully', ['transport' => $transport]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Transport deletion failed');
        }
    }
}
