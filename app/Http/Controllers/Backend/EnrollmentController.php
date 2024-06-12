<?php

namespace App\Http\Controllers\Backend;

use App\Models\Enrollment;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnrollmentRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class EnrollmentController extends Controller
{
    public function index()
    {
        try {
            $enrollments = Enrollment::paginate(10);
            $metaData = Helper::getMetaData($enrollments);
            return Response::success(200, 'Enrollment retrieved successfully', ['enrollments' => $enrollments->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $enrollment = Enrollment::find($id);
            if (!$enrollment) {
                 return Response::notFound(404, 'Enrollment not found');
            }
            return Response::success(200, 'Enrollment retrieved successfully', ['enrollment' => $enrollment], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Enrollment retrieval failed', 500);
        }
    }

    public function store(EnrollmentRequest $request)
    {
        try {
            $enrollment = Enrollment::create($request->all());
            return Response::success(201, 'Enrollment created successfully', ['enrollment' => $enrollment]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Enrollment creation failed');
        }
    }

    public function update(EnrollmentRequest $request, string $id)
    {
        try {
            $enrollment = Enrollment::find($id);
            if (!$enrollment) {
                 return Response::notFound(404, 'Enrollment not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $enrollment->update($validatedData);
            return Response::success(200, 'Enrollment updated successfully', ['enrollment' => $enrollment]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Enrollment updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $enrollment = Enrollment::find($id);
            if (!$enrollment) {
                return Response::notFound(404, 'Enrollment not found');
            }

            $enrollment->delete();
            return Response::success(200, 'Enrollment deleted successfully', ['enrollment' => $enrollment]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Enrollment deletion failed');
        }
    }
}
