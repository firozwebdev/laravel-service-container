<?php

namespace App\Http\Controllers;

use App\Models\Hostel;

use App\Http\Requests\HostelRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class HostelController extends Controller
{
    public function index()
    {
        try {
            $hostels = Hostel::paginate(10);
            $metaData = Helper::getMetaData($hostels);
            return Response::success(200, 'Hostel retrieved successfully', ['hostels' => $hostels->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $hostel = Hostel::find($id);
            if (!$hostel) {
                 return Response::notFound(404, 'Hostel not found');
            }
            return Response::success(200, 'Hostel retrieved successfully', ['hostel' => $hostel], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Hostel retrieval failed', 500);
        }
    }

    public function store(HostelRequest $request)
    {
        try {
            $hostel = Hostel::create($request->all());
            return Response::success(201, 'Hostel created successfully', ['hostel' => $hostel]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Hostel creation failed');
        }
    }

    public function update(HostelRequest $request, string $id)
    {
        try {
            $hostel = Hostel::find($id);
            if (!$hostel) {
                 return Response::notFound(404, 'Hostel not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $hostel->update($validatedData);
            return Response::success(200, 'Hostel updated successfully', ['hostel' => $hostel]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Hostel updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $hostel = Hostel::find($id);
            if (!$hostel) {
                return Response::notFound(404, 'Hostel not found');
            }

            $hostel->delete();
            return Response::success(200, 'Hostel deleted successfully', ['hostel' => $hostel]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Hostel deletion failed');
        }
    }
}
