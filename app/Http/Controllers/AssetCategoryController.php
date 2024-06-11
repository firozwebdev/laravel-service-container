<?php

namespace App\Http\Controllers;

use App\Models\AssetCategory;

use App\Http\Requests\AssetCategoryRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class AssetCategoryController extends Controller
{
    public function index()
    {
        try {
            $assetCategories = AssetCategory::paginate(10);
            $metaData = Helper::getMetaData($assetCategories);
            return Response::success(200, 'AssetCategory retrieved successfully', ['assetCategories' => $assetCategories->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $assetCategory = AssetCategory::find($id);
            if (!$assetCategory) {
                 return Response::notFound(404, 'AssetCategory not found');
            }
            return Response::success(200, 'AssetCategory retrieved successfully', ['assetCategory' => $assetCategory], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, AssetCategory retrieval failed', 500);
        }
    }

    public function store(AssetCategoryRequest $request)
    {
        try {
            $assetCategory = AssetCategory::create($request->all());
            return Response::success(201, 'AssetCategory created successfully', ['assetCategory' => $assetCategory]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, AssetCategory creation failed');
        }
    }

    public function update(AssetCategoryRequest $request, string $id)
    {
        try {
            $assetCategory = AssetCategory::find($id);
            if (!$assetCategory) {
                 return Response::notFound(404, 'AssetCategory not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $assetCategory->update($validatedData);
            return Response::success(200, 'AssetCategory updated successfully', ['assetCategory' => $assetCategory]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, AssetCategory updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $assetCategory = AssetCategory::find($id);
            if (!$assetCategory) {
                return Response::notFound(404, 'AssetCategory not found');
            }

            $assetCategory->delete();
            return Response::success(200, 'AssetCategory deleted successfully', ['assetCategory' => $assetCategory]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, AssetCategory deletion failed');
        }
    }
}
