<?php

namespace App\Http\Controllers;

use App\Models\Attendance;

use App\Http\Requests\AttendanceRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class AttendanceController extends Controller
{
    public function index()
    {
        try {
            $attendances = Attendance::paginate(10);
            $metaData = Helper::getMetaData($attendances);
            return Response::success(200, 'Attendance retrieved successfully', ['attendances' => $attendances->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $attendance = Attendance::find($id);
            if (!$attendance) {
                 return Response::notFound(404, 'Attendance not found');
            }
            return Response::success(200, 'Attendance retrieved successfully', ['attendance' => $attendance], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Attendance retrieval failed', 500);
        }
    }

    public function store(AttendanceRequest $request)
    {
        try {
            $attendance = Attendance::create($request->all());
            return Response::success(201, 'Attendance created successfully', ['attendance' => $attendance]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Attendance creation failed');
        }
    }

    public function update(AttendanceRequest $request, string $id)
    {
        try {
            $attendance = Attendance::find($id);
            if (!$attendance) {
                 return Response::notFound(404, 'Attendance not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $attendance->update($validatedData);
            return Response::success(200, 'Attendance updated successfully', ['attendance' => $attendance]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Attendance updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $attendance = Attendance::find($id);
            if (!$attendance) {
                return Response::notFound(404, 'Attendance not found');
            }

            $attendance->delete();
            return Response::success(200, 'Attendance deleted successfully', ['attendance' => $attendance]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Attendance deletion failed');
        }
    }
}
