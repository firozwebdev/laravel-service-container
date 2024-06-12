<?php

namespace App\Http\Controllers;

use App\Models\Result;

use App\Http\Requests\ResultRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class ResultController extends Controller
{
    public function index()
    {
        try {
            $results = Result::paginate(10);
            $metaData = Helper::getMetaData($results);
            return Response::success(200, 'Result retrieved successfully', ['results' => $results->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $result = Result::find($id);
            if (!$result) {
                 return Response::notFound(404, 'Result not found');
            }
            return Response::success(200, 'Result retrieved successfully', ['result' => $result], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Result retrieval failed', 500);
        }
    }

    public function store(ResultRequest $request)
    {
        try {
            $result = Result::create($request->all());
            return Response::success(201, 'Result created successfully', ['result' => $result]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Result creation failed');
        }
    }

    public function update(ResultRequest $request, string $id)
    {
        try {
            $result = Result::find($id);
            if (!$result) {
                 return Response::notFound(404, 'Result not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $result->update($validatedData);
            return Response::success(200, 'Result updated successfully', ['result' => $result]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Result updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $result = Result::find($id);
            if (!$result) {
                return Response::notFound(404, 'Result not found');
            }

            $result->delete();
            return Response::success(200, 'Result deleted successfully', ['result' => $result]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Result deletion failed');
        }
    }
}
