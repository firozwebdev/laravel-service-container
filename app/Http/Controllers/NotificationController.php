<?php

namespace App\Http\Controllers;

use App\Models\Notification;

use App\Http\Requests\NotificationRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function index()
    {
        try {
            $notifications = Notification::paginate(10);
            $metaData = Helper::getMetaData($notifications);
            return Response::success(200, 'Notification retrieved successfully', ['notifications' => $notifications->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $notification = Notification::find($id);
            if (!$notification) {
                 return Response::notFound(404, 'Notification not found');
            }
            return Response::success(200, 'Notification retrieved successfully', ['notification' => $notification], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Notification retrieval failed', 500);
        }
    }

    public function store(NotificationRequest $request)
    {
        try {
            $notification = Notification::create($request->all());
            return Response::success(201, 'Notification created successfully', ['notification' => $notification]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Notification creation failed');
        }
    }

    public function update(NotificationRequest $request, string $id)
    {
        try {
            $notification = Notification::find($id);
            if (!$notification) {
                 return Response::notFound(404, 'Notification not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $notification->update($validatedData);
            return Response::success(200, 'Notification updated successfully', ['notification' => $notification]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Notification updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $notification = Notification::find($id);
            if (!$notification) {
                return Response::notFound(404, 'Notification not found');
            }

            $notification->delete();
            return Response::success(200, 'Notification deleted successfully', ['notification' => $notification]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Notification deletion failed');
        }
    }
}
