<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;

use App\Http\Requests\OpportunityRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class OpportunityController extends Controller
{
    public function index()
    {
        try {
            $opportunities = Opportunity::paginate(10);
            $metaData = Helper::getMetaData($opportunities);
            return Response::success(200, 'Opportunity retrieved successfully', ['opportunities' => $opportunities->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $opportunity = Opportunity::find($id);
            if (!$opportunity) {
                return Response::notFound('Sorry, Opportunity not found!', 404);
            }
            return Response::success(200, 'Opportunity retrieved successfully', ['opportunity' => $opportunity], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Opportunity retrieval failed', 500);
        }
    }

    public function store(OpportunityRequest $request)
    {
        try {
            $opportunity = Opportunity::create($request->all());
            return Response::success(201, 'Opportunity created successfully', ['opportunity' => $opportunity]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Opportunity creation failed');
        }
    }

    public function update(OpportunityRequest $request, string $id)
    {
        try {
            $opportunity = Opportunity::find($id);
            if (!$opportunity) {
                return Response::notFound(404, 'Opportunity not found');
            }

            $opportunity->update($request->all());
            return Response::success(200, 'Opportunity updated successfully', ['opportunity' => $opportunity]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Opportunity updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $opportunity = Opportunity::find($id);
            if (!$opportunity) {
                return Response::notFound(404, 'Opportunity not found');
            }

            $opportunity->delete();
            return Response::success(200, 'Opportunity deleted successfully', ['opportunity' => $opportunity]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Opportunity deletion failed');
        }
    }
}
