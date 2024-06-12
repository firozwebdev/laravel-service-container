<?php

namespace App\Http\Controllers;

use App\Models\Department;

use App\Http\Requests\DepartmentRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class DepartmentController extends Controller
{
    public function index()
    {
        try {
            $departments = Department::paginate(10);
            $metaData = Helper::getMetaData($departments);
            return Response::success(200, 'Department retrieved successfully', ['departments' => $departments->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $department = Department::find($id);
            if (!$department) {
                 return Response::notFound(404, 'Department not found');
            }
            return Response::success(200, 'Department retrieved successfully', ['department' => $department], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Department retrieval failed', 500);
        }
    }

    public function store(DepartmentRequest $request)
    {
        try {
            $department = Department::create($request->all());
            return Response::success(201, 'Department created successfully', ['department' => $department]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Department creation failed');
        }
    }

    public function update(DepartmentRequest $request, string $id)
    {
        try {
            $department = Department::find($id);
            if (!$department) {
                 return Response::notFound(404, 'Department not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $department->update($validatedData);
            return Response::success(200, 'Department updated successfully', ['department' => $department]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Department updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $department = Department::find($id);
            if (!$department) {
                return Response::notFound(404, 'Department not found');
            }

            $department->delete();
            return Response::success(200, 'Department deleted successfully', ['department' => $department]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Department deletion failed');
        }
    }
}
