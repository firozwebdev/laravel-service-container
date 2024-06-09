<?php

namespace App\Http\Controllers;

use App\Models\Lead;

use App\Http\Requests\LeadRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::paginate(10);
        $metaData  = Helper::getMetaData($leads);
        //return response()->json($leads);
        return Response::success(200, 'Lead retrieved successfully', ['leads' => $leads->items()], $metaData);
    }

    public function show($id)
    {
        $lead = Lead::findOrFail($id);
        return Response::success(200, 'Lead retrieved successfully', ['lead' => $lead],  $metaData = []);
    }

    public function store(LeadRequest $request)
    {
        $lead = Lead::create($request->all());
        return Response::success(201, 'Lead  created successfully', ['lead ' => $lead ]);
    }

    public function update(LeadRequest $request, $id)
    {
        $lead = Lead::findOrFail($id);
        $lead->update($request->all());
        return Response::success(200, 'Lead updated successfully', ['lead' => $lead]);
    }

    public function destroy($id)
    {
        Lead::destroy($id);
        return Response::success(200, 'Lead deleted successfully', ['lead' => $lead]);
    }
}
