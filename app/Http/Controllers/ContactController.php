<?php

namespace App\Http\Controllers;

use App\Models\Contact;

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
            return Response::success(200, 'Contact retrieved successfully', ['contacts' => $contacts->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $contact = Contact::find($id);
            if (!$contact) {
                return Response::notFound('Sorry, Contact not found!', 404);
            }
            return Response::success(200, 'Contact retrieved successfully', ['contact' => $contact], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Contact retrieval failed', 500);
        }
    }

    public function store(ContactRequest $request)
    {
        try {
            $contact = Contact::create($request->all());
            return Response::success(201, 'Contact created successfully', ['contact' => $contact]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Contact creation failed');
        }
    }

    public function update(ContactRequest $request, string $id)
    {
        try {
            $contact = Contact::find($id);
            if (!$contact) {
                return Response::notFound(404, 'Contact not found');
            }

            $contact->update($request->all());
            return Response::success(200, 'Contact updated successfully', ['contact' => $contact]);
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
            return Response::success(200, 'Contact deleted successfully', ['contact' => $contact]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Contact deletion failed');
        }
    }
}
