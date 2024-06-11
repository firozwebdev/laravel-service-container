<?php

namespace App\Http\Controllers;

use App\Models\Test;

use App\Http\Requests\TestRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    public function index()
    {
        try {
            $tests = Test::paginate(10);
            $metaData = Helper::getMetaData($tests);
            return view('test.index', compact('tests'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function create()
    {
        return view('test.create');
    }

    public function store(TestRequest $request)
    {
        try {
            $test = Test::create($request->all());
            return redirect()->route('test.index')->with('success', 'Test created successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Test creation failed');
        }
    }

    public function show(string $id)
    {
        try {
            $test = Test::find($id);
            if (!$test) {
                return Response::notFound(404, 'Test not found');
            }
            return view('test.show', compact('test'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Test retrieval failed', 500);
        }
    }
    
    public function edit(Test $test)
    {
        return view('test.edit', compact('test'));
    }

    public function update(TestRequest $request, string $id)
    {
        try {
            $test = Test::find($id);
            if (!$test) {
                return Response::notFound(404, 'Test not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed
            $test->update($validatedData);
            return redirect()->route('test.index')->with('success', 'Test updated successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Test updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $test = Test::find($id);
            if (!$test) {
                return Response::notFound(404, 'Test not found');
            }
            $test->delete();
            return redirect()->route('test.index')->with('success', 'Test deleted successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Test deletion failed');
        }
    }
}
