<?php

namespace App\Http\Controllers;

use App\Models\Module;

use App\Http\Requests\ModuleRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class ModuleController extends Controller
{
    public function index()
    {
        try {
            $modules = Module::paginate(10);
            $metaData = Helper::getMetaData($modules);
            return Response::success(200, 'Module retrieved successfully', ['modules' => $modules->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $module = Module::find($id);
            if (!$module) {
                 return Response::notFound(404, 'Module not found');
            }
            return Response::success(200, 'Module retrieved successfully', ['module' => $module], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Module retrieval failed', 500);
        }
    }

    public function store(ModuleRequest $request)
    {
        try {
            $module = Module::create($request->all());
            return Response::success(201, 'Module created successfully', ['module' => $module]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Module creation failed');
        }
    }

    public function update(ModuleRequest $request, string $id)
    {
        try {
            $module = Module::find($id);
            if (!$module) {
                 return Response::notFound(404, 'Module not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $module->update($validatedData);
            return Response::success(200, 'Module updated successfully', ['module' => $module]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Module updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $module = Module::find($id);
            if (!$module) {
                return Response::notFound(404, 'Module not found');
            }

            $module->delete();
            return Response::success(200, 'Module deleted successfully', ['module' => $module]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Module deletion failed');
        }
    }
}
