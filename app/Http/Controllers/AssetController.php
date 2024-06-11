<?php

namespace App\Http\Controllers;

use App\Models\Asset;

use App\Http\Requests\AssetRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class AssetController extends Controller
{
    public function index()
    {
        try {
            $assets = Asset::paginate(10);
            $metaData = Helper::getMetaData($assets);
            return Response::success(200, 'Asset retrieved successfully', ['assets' => $assets->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $asset = Asset::find($id);
            if (!$asset) {
                 return Response::notFound(404, 'Asset not found');
            }
            return Response::success(200, 'Asset retrieved successfully', ['asset' => $asset], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Asset retrieval failed', 500);
        }
    }

    public function store(AssetRequest $request)
    {
        try {
            $asset = Asset::create($request->all());
            return Response::success(201, 'Asset created successfully', ['asset' => $asset]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Asset creation failed');
        }
    }

    public function update(AssetRequest $request, string $id)
    {
        try {
            $asset = Asset::find($id);
            if (!$asset) {
                 return Response::notFound(404, 'Asset not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $asset->update($validatedData);
            return Response::success(200, 'Asset updated successfully', ['asset' => $asset]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Asset updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $asset = Asset::find($id);
            if (!$asset) {
                return Response::notFound(404, 'Asset not found');
            }

            $asset->delete();
            return Response::success(200, 'Asset deleted successfully', ['asset' => $asset]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Asset deletion failed');
        }
    }
}
