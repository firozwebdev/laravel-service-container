<?php

namespace App\Http\Controllers;

use App\Models\Option;

use App\Http\Requests\OptionRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class OptionController extends Controller
{
    public function index()
    {
        try {
            $options = Option::paginate(10);
            $metaData = Helper::getMetaData($options);
            return Response::success(200, 'Option retrieved successfully', ['options' => $options->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $option = Option::find($id);
            if (!$option) {
                 return Response::notFound(404, 'Option not found');
            }
            return Response::success(200, 'Option retrieved successfully', ['option' => $option], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Option retrieval failed', 500);
        }
    }

    public function store(OptionRequest $request)
    {
        try {
            $option = Option::create($request->all());
            return Response::success(201, 'Option created successfully', ['option' => $option]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Option creation failed');
        }
    }

    public function update(OptionRequest $request, string $id)
    {
        try {
            $option = Option::find($id);
            if (!$option) {
                 return Response::notFound(404, 'Option not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $option->update($validatedData);
            return Response::success(200, 'Option updated successfully', ['option' => $option]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Option updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $option = Option::find($id);
            if (!$option) {
                return Response::notFound(404, 'Option not found');
            }

            $option->delete();
            return Response::success(200, 'Option deleted successfully', ['option' => $option]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Option deletion failed');
        }
    }
}
