<?php

namespace App\Http\Controllers;

use App\Models\AssetDepreciation;

use App\Http\Requests\AssetDepreciationRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class AssetDepreciationController extends Controller
{
    public function index()
    {
        try {
            $assetDepreciations = AssetDepreciation::paginate(10);
            $metaData = Helper::getMetaData($assetDepreciations);
            return Response::success(200, 'AssetDepreciation retrieved successfully', ['assetDepreciations' => $assetDepreciations->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $assetDepreciation = AssetDepreciation::find($id);
            if (!$assetDepreciation) {
                 return Response::notFound(404, 'AssetDepreciation not found');
            }
            return Response::success(200, 'AssetDepreciation retrieved successfully', ['assetDepreciation' => $assetDepreciation], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, AssetDepreciation retrieval failed', 500);
        }
    }

    public function store(AssetDepreciationRequest $request)
    {
        try {
            $assetDepreciation = AssetDepreciation::create($request->all());
            return Response::success(201, 'AssetDepreciation created successfully', ['assetDepreciation' => $assetDepreciation]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, AssetDepreciation creation failed');
        }
    }

    public function update(AssetDepreciationRequest $request, string $id)
    {
        try {
            $assetDepreciation = AssetDepreciation::find($id);
            if (!$assetDepreciation) {
                 return Response::notFound(404, 'AssetDepreciation not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $assetDepreciation->update($validatedData);
            return Response::success(200, 'AssetDepreciation updated successfully', ['assetDepreciation' => $assetDepreciation]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, AssetDepreciation updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $assetDepreciation = AssetDepreciation::find($id);
            if (!$assetDepreciation) {
                return Response::notFound(404, 'AssetDepreciation not found');
            }

            $assetDepreciation->delete();
            return Response::success(200, 'AssetDepreciation deleted successfully', ['assetDepreciation' => $assetDepreciation]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, AssetDepreciation deletion failed');
        }
    }
}
