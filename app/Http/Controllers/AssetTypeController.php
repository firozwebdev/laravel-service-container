<?php

namespace App\Http\Controllers;

use App\Models\AssetType;

use App\Http\Requests\AssetTypeRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class AssetTypeController extends Controller
{
    public function index()
    {
        try {
            $assetTypes = AssetType::paginate(10);
            $metaData = Helper::getMetaData($assetTypes);
            return Response::success(200, 'AssetType retrieved successfully', ['assetTypes' => $assetTypes->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $assetType = AssetType::find($id);
            if (!$assetType) {
                 return Response::notFound(404, 'AssetType not found');
            }
            return Response::success(200, 'AssetType retrieved successfully', ['assetType' => $assetType], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, AssetType retrieval failed', 500);
        }
    }

    public function store(AssetTypeRequest $request)
    {
        try {
            $assetType = AssetType::create($request->all());
            return Response::success(201, 'AssetType created successfully', ['assetType' => $assetType]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, AssetType creation failed');
        }
    }

    public function update(AssetTypeRequest $request, string $id)
    {
        try {
            $assetType = AssetType::find($id);
            if (!$assetType) {
                 return Response::notFound(404, 'AssetType not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $assetType->update($validatedData);
            return Response::success(200, 'AssetType updated successfully', ['assetType' => $assetType]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, AssetType updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $assetType = AssetType::find($id);
            if (!$assetType) {
                return Response::notFound(404, 'AssetType not found');
            }

            $assetType->delete();
            return Response::success(200, 'AssetType deleted successfully', ['assetType' => $assetType]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, AssetType deletion failed');
        }
    }
}
