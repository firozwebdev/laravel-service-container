<?php

namespace App\Http\Controllers;

use App\Models\Fee;

use App\Http\Requests\FeeRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class FeeController extends Controller
{
    public function index()
    {
        try {
            $fees = Fee::paginate(10);
            $metaData = Helper::getMetaData($fees);
            return Response::success(200, 'Fee retrieved successfully', ['fees' => $fees->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $fee = Fee::find($id);
            if (!$fee) {
                 return Response::notFound(404, 'Fee not found');
            }
            return Response::success(200, 'Fee retrieved successfully', ['fee' => $fee], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Fee retrieval failed', 500);
        }
    }

    public function store(FeeRequest $request)
    {
        try {
            $fee = Fee::create($request->all());
            return Response::success(201, 'Fee created successfully', ['fee' => $fee]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Fee creation failed');
        }
    }

    public function update(FeeRequest $request, string $id)
    {
        try {
            $fee = Fee::find($id);
            if (!$fee) {
                 return Response::notFound(404, 'Fee not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $fee->update($validatedData);
            return Response::success(200, 'Fee updated successfully', ['fee' => $fee]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Fee updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $fee = Fee::find($id);
            if (!$fee) {
                return Response::notFound(404, 'Fee not found');
            }

            $fee->delete();
            return Response::success(200, 'Fee deleted successfully', ['fee' => $fee]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Fee deletion failed');
        }
    }
}
