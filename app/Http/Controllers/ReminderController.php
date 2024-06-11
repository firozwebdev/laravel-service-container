<?php

namespace App\Http\Controllers;

use App\Models\Reminder;

use App\Http\Requests\ReminderRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class ReminderController extends Controller
{
    public function index()
    {
        try {
            $reminders = Reminder::paginate(10);
            $metaData = Helper::getMetaData($reminders);
            return view('reminder.index', compact('reminders'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function create()
    {
        return view('reminder.create');
    }

    public function store(ReminderRequest $request)
    {
        try {
            $reminder = Reminder::create($request->all());
            return redirect()->route('reminder.index')->with('success', 'Reminder created successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Reminder creation failed');
        }
    }

    public function show(string $id)
    {
        try {
            $reminder = Reminder::find($id);
            if (!$reminder) {
                return Response::notFound(404, 'Reminder not found');
            }
            return view('reminder.show', compact('reminder'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Reminder retrieval failed', 500);
        }
    }
    
    public function edit(Reminder $reminder)
    {
        return view('reminder.edit', compact('reminder'));
    }

    public function update(ReminderRequest $request, string $id)
    {
        try {
            $reminder = Reminder::find($id);
            if (!$reminder) {
                return Response::notFound(404, 'Reminder not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed
            $reminder->update($validatedData);
            return redirect()->route('reminder.index')->with('success', 'Reminder updated successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Reminder updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $reminder = Reminder::find($id);
            if (!$reminder) {
                return Response::notFound(404, 'Reminder not found');
            }
            $reminder->delete();
            return redirect()->route('reminder.index')->with('success', 'Reminder deleted successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Reminder deletion failed');
        }
    }
}
