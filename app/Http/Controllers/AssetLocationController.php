<?php

namespace App\Http\Controllers;

use App\Models\AssetLocation;

use App\Http\Requests\AssetLocationRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class AssetLocationController extends Controller
{
    public function index()
    {
        try {
            $assetLocations = AssetLocation::paginate(10);
            $metaData = Helper::getMetaData($assetLocations);
            return Response::success(200, 'AssetLocation retrieved successfully', ['assetLocations' => $assetLocations->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $assetLocation = AssetLocation::find($id);
            if (!$assetLocation) {
                 return Response::notFound(404, 'AssetLocation not found');
            }
            return Response::success(200, 'AssetLocation retrieved successfully', ['assetLocation' => $assetLocation], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, AssetLocation retrieval failed', 500);
        }
    }

    public function store(AssetLocationRequest $request)
    {
        try {
            $assetLocation = AssetLocation::create($request->all());
            return Response::success(201, 'AssetLocation created successfully', ['assetLocation' => $assetLocation]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, AssetLocation creation failed');
        }
    }

    public function update(AssetLocationRequest $request, string $id)
    {
        try {
            $assetLocation = AssetLocation::find($id);
            if (!$assetLocation) {
                 return Response::notFound(404, 'AssetLocation not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $assetLocation->update($validatedData);
            return Response::success(200, 'AssetLocation updated successfully', ['assetLocation' => $assetLocation]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, AssetLocation updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $assetLocation = AssetLocation::find($id);
            if (!$assetLocation) {
                return Response::notFound(404, 'AssetLocation not found');
            }

            $assetLocation->delete();
            return Response::success(200, 'AssetLocation deleted successfully', ['assetLocation' => $assetLocation]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, AssetLocation deletion failed');
        }
    }
}
