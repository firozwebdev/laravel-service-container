<?php

namespace App\Http\Controllers;

use App\Models\LibraryBook;

use App\Http\Requests\LibraryBookRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class LibraryBookController extends Controller
{
    public function index()
    {
        try {
            $libraryBooks = LibraryBook::paginate(10);
            $metaData = Helper::getMetaData($libraryBooks);
            return Response::success(200, 'LibraryBook retrieved successfully', ['libraryBooks' => $libraryBooks->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $libraryBook = LibraryBook::find($id);
            if (!$libraryBook) {
                 return Response::notFound(404, 'LibraryBook not found');
            }
            return Response::success(200, 'LibraryBook retrieved successfully', ['libraryBook' => $libraryBook], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, LibraryBook retrieval failed', 500);
        }
    }

    public function store(LibraryBookRequest $request)
    {
        try {
            $libraryBook = LibraryBook::create($request->all());
            return Response::success(201, 'LibraryBook created successfully', ['libraryBook' => $libraryBook]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, LibraryBook creation failed');
        }
    }

    public function update(LibraryBookRequest $request, string $id)
    {
        try {
            $libraryBook = LibraryBook::find($id);
            if (!$libraryBook) {
                 return Response::notFound(404, 'LibraryBook not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $libraryBook->update($validatedData);
            return Response::success(200, 'LibraryBook updated successfully', ['libraryBook' => $libraryBook]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, LibraryBook updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $libraryBook = LibraryBook::find($id);
            if (!$libraryBook) {
                return Response::notFound(404, 'LibraryBook not found');
            }

            $libraryBook->delete();
            return Response::success(200, 'LibraryBook deleted successfully', ['libraryBook' => $libraryBook]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, LibraryBook deletion failed');
        }
    }
}
