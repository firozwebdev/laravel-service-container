<?php

namespace App\Http\Controllers;

use App\Models\Lead;

use App\Http\Requests\LeadRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class LeadController extends Controller
{
    public function index()
    {
        try {
            $leads = Lead::paginate(10);
            $metaData = Helper::getMetaData($leads);
            return Response::success(200, 'Lead retrieved successfully', ['leads' => $leads->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $lead = Lead::find($id);
            if (!$lead) {
                 return Response::notFound(404, 'Lead not found');
            }
            return Response::success(200, 'Lead retrieved successfully', ['lead' => $lead], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Lead retrieval failed', 500);
        }
    }

    public function store(LeadRequest $request)
    {
        try {
            $lead = Lead::create($request->all());
            return Response::success(201, 'Lead created successfully', ['lead' => $lead]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Lead creation failed');
        }
    }

    public function update(LeadRequest $request, string $id)
    {
        try {
            $lead = Lead::find($id);
            if (!$lead) {
                 return Response::notFound(404, 'Lead not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $lead->update($validatedData);
            return Response::success(200, 'Lead updated successfully', ['lead' => $lead]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Lead updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $lead = Lead::find($id);
            if (!$lead) {
                return Response::notFound(404, 'Lead not found');
            }

            $lead->delete();
            return Response::success(200, 'Lead deleted successfully', ['lead' => $lead]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Lead deletion failed');
        }
    }
}
