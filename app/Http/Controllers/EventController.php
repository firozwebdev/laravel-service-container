<?php

namespace App\Http\Controllers;

use App\Models\Event;

use App\Http\Requests\EventRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function index()
    {
        try {
            $events = Event::paginate(10);
            $metaData = Helper::getMetaData($events);
            return Response::success(200, 'Event retrieved successfully', ['events' => $events->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $event = Event::find($id);
            if (!$event) {
                 return Response::notFound(404, 'Event not found');
            }
            return Response::success(200, 'Event retrieved successfully', ['event' => $event], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Event retrieval failed', 500);
        }
    }

    public function store(EventRequest $request)
    {
        try {
            $event = Event::create($request->all());
            return Response::success(201, 'Event created successfully', ['event' => $event]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Event creation failed');
        }
    }

    public function update(EventRequest $request, string $id)
    {
        try {
            $event = Event::find($id);
            if (!$event) {
                 return Response::notFound(404, 'Event not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $event->update($validatedData);
            return Response::success(200, 'Event updated successfully', ['event' => $event]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Event updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $event = Event::find($id);
            if (!$event) {
                return Response::notFound(404, 'Event not found');
            }

            $event->delete();
            return Response::success(200, 'Event deleted successfully', ['event' => $event]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Event deletion failed');
        }
    }
}
