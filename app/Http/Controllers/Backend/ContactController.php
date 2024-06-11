<?php

namespace App\Http\Controllers\Backend;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        try {
            $contacts = Contact::paginate(10);
            $metaData = Helper::getMetaData($contacts);
            return view('contact.index', compact('contacts'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function create()
    {
        return view('contact.create');
    }

    public function store(ContactRequest $request)
    {
        try {
            $contact = Contact::create($request->all());
            return redirect()->route('contact.index')->with('success', 'Contact created successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Contact creation failed');
        }
    }

    public function show(string $id)
    {
        try {
            $contact = Contact::find($id);
            if (!$contact) {
                return Response::notFound(404, 'Contact not found');
            }
            return view('contact.show', compact('contact'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Contact retrieval failed', 500);
        }
    }
    
    public function edit(Contact $contact)
    {
        return view('contact.edit', compact('contact'));
    }

    public function update(ContactRequest $request, string $id)
    {
        try {
            $contact = Contact::find($id);
            if (!$contact) {
                return Response::notFound(404, 'Contact not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed
            $contact->update($validatedData);
            return redirect()->route('contact.index')->with('success', 'Contact updated successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Contact updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $contact = Contact::find($id);
            if (!$contact) {
                return Response::notFound(404, 'Contact not found');
            }
            $contact->delete();
            return redirect()->route('contact.index')->with('success', 'Contact deleted successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Contact deletion failed');
        }
    }
}
