<?php

namespace App\Http\Controllers;

use App\Models\Room;

use App\Http\Requests\RoomRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class RoomController extends Controller
{
    public function index()
    {
        try {
            $rooms = Room::paginate(10);
            $metaData = Helper::getMetaData($rooms);
            return Response::success(200, 'Room retrieved successfully', ['rooms' => $rooms->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $room = Room::find($id);
            if (!$room) {
                 return Response::notFound(404, 'Room not found');
            }
            return Response::success(200, 'Room retrieved successfully', ['room' => $room], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Room retrieval failed', 500);
        }
    }

    public function store(RoomRequest $request)
    {
        try {
            $room = Room::create($request->all());
            return Response::success(201, 'Room created successfully', ['room' => $room]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Room creation failed');
        }
    }

    public function update(RoomRequest $request, string $id)
    {
        try {
            $room = Room::find($id);
            if (!$room) {
                 return Response::notFound(404, 'Room not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $room->update($validatedData);
            return Response::success(200, 'Room updated successfully', ['room' => $room]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Room updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $room = Room::find($id);
            if (!$room) {
                return Response::notFound(404, 'Room not found');
            }

            $room->delete();
            return Response::success(200, 'Room deleted successfully', ['room' => $room]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Room deletion failed');
        }
    }
}
