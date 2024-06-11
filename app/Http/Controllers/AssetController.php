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
            return view('asset.index', compact('assets'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function create()
    {
        return view('asset.create');
    }

    public function store(AssetRequest $request)
    {
        try {
            $asset = Asset::create($request->all());
            return redirect()->route('asset.index')->with('success', 'Asset created successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Asset creation failed');
        }
    }

    public function show(string $id)
    {
        try {
            $asset = Asset::find($id);
            if (!$asset) {
                return Response::notFound(404, 'Asset not found');
            }
            return view('asset.show', compact('asset'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Asset retrieval failed', 500);
        }
    }
    
    public function edit(Asset $asset)
    {
        return view('asset.edit', compact('asset'));
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
            return redirect()->route('asset.index')->with('success', 'Asset updated successfully.');
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
            return redirect()->route('asset.index')->with('success', 'Asset deleted successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Asset deletion failed');
        }
    }
}
