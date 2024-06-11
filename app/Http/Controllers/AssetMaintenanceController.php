<?php

namespace App\Http\Controllers;

use App\Models\AssetMaintenance;

use App\Http\Requests\AssetMaintenanceRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class AssetMaintenanceController extends Controller
{
    public function index()
    {
        try {
            $assetMaintenances = AssetMaintenance::paginate(10);
            $metaData = Helper::getMetaData($assetMaintenances);
            return Response::success(200, 'AssetMaintenance retrieved successfully', ['assetMaintenances' => $assetMaintenances->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $assetMaintenance = AssetMaintenance::find($id);
            if (!$assetMaintenance) {
                 return Response::notFound(404, 'AssetMaintenance not found');
            }
            return Response::success(200, 'AssetMaintenance retrieved successfully', ['assetMaintenance' => $assetMaintenance], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, AssetMaintenance retrieval failed', 500);
        }
    }

    public function store(AssetMaintenanceRequest $request)
    {
        try {
            $assetMaintenance = AssetMaintenance::create($request->all());
            return Response::success(201, 'AssetMaintenance created successfully', ['assetMaintenance' => $assetMaintenance]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, AssetMaintenance creation failed');
        }
    }

    public function update(AssetMaintenanceRequest $request, string $id)
    {
        try {
            $assetMaintenance = AssetMaintenance::find($id);
            if (!$assetMaintenance) {
                 return Response::notFound(404, 'AssetMaintenance not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $assetMaintenance->update($validatedData);
            return Response::success(200, 'AssetMaintenance updated successfully', ['assetMaintenance' => $assetMaintenance]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, AssetMaintenance updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $assetMaintenance = AssetMaintenance::find($id);
            if (!$assetMaintenance) {
                return Response::notFound(404, 'AssetMaintenance not found');
            }

            $assetMaintenance->delete();
            return Response::success(200, 'AssetMaintenance deleted successfully', ['assetMaintenance' => $assetMaintenance]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, AssetMaintenance deletion failed');
        }
    }
}
