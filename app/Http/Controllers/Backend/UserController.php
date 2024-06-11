<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::paginate(10);
            $metaData = Helper::getMetaData($users);
            return view('user.index', compact('users'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(UserRequest $request)
    {
        try {
            $user = User::create($request->all());
            return redirect()->route('user.index')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, User creation failed');
        }
    }

    public function show(string $id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return Response::notFound(404, 'User not found');
            }
            return view('user.show', compact('user'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, User retrieval failed', 500);
        }
    }
    
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(UserRequest $request, string $id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return Response::notFound(404, 'User not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed
            $user->update($validatedData);
            return redirect()->route('user.index')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, User updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return Response::notFound(404, 'User not found');
            }
            $user->delete();
            return redirect()->route('user.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, User deletion failed');
        }
    }
}
