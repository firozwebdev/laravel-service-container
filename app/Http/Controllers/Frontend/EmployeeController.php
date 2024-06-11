<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    public function index()
    {
        try {
            $employees = Employee::paginate(10);
            $metaData = Helper::getMetaData($employees);
            return Response::success(200, 'Employee retrieved successfully', ['employees' => $employees->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $employee = Employee::find($id);
            if (!$employee) {
                 return Response::notFound(404, 'Employee not found');
            }
            return Response::success(200, 'Employee retrieved successfully', ['employee' => $employee], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Employee retrieval failed', 500);
        }
    }

    public function store(EmployeeRequest $request)
    {
        try {
            $employee = Employee::create($request->all());
            return Response::success(201, 'Employee created successfully', ['employee' => $employee]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Employee creation failed');
        }
    }

    public function update(EmployeeRequest $request, string $id)
    {
        try {
            $employee = Employee::find($id);
            if (!$employee) {
                 return Response::notFound(404, 'Employee not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $employee->update($validatedData);
            return Response::success(200, 'Employee updated successfully', ['employee' => $employee]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Employee updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $employee = Employee::find($id);
            if (!$employee) {
                return Response::notFound(404, 'Employee not found');
            }

            $employee->delete();
            return Response::success(200, 'Employee deleted successfully', ['employee' => $employee]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Employee deletion failed');
        }
    }
}
