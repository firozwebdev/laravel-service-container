<?php

namespace App\Http\Controllers;

use App\Models\Borrow;

use App\Http\Requests\BorrowRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class BorrowController extends Controller
{
    public function index()
    {
        try {
            $borrows = Borrow::paginate(10);
            $metaData = Helper::getMetaData($borrows);
            return Response::success(200, 'Borrow retrieved successfully', ['borrows' => $borrows->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $borrow = Borrow::find($id);
            if (!$borrow) {
                 return Response::notFound(404, 'Borrow not found');
            }
            return Response::success(200, 'Borrow retrieved successfully', ['borrow' => $borrow], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Borrow retrieval failed', 500);
        }
    }

    public function store(BorrowRequest $request)
    {
        try {
            $borrow = Borrow::create($request->all());
            return Response::success(201, 'Borrow created successfully', ['borrow' => $borrow]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Borrow creation failed');
        }
    }

    public function update(BorrowRequest $request, string $id)
    {
        try {
            $borrow = Borrow::find($id);
            if (!$borrow) {
                 return Response::notFound(404, 'Borrow not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $borrow->update($validatedData);
            return Response::success(200, 'Borrow updated successfully', ['borrow' => $borrow]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Borrow updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $borrow = Borrow::find($id);
            if (!$borrow) {
                return Response::notFound(404, 'Borrow not found');
            }

            $borrow->delete();
            return Response::success(200, 'Borrow deleted successfully', ['borrow' => $borrow]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Borrow deletion failed');
        }
    }
}
