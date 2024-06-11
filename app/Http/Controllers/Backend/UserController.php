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
            return Response::success(200, 'User retrieved successfully', ['users' => $users->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                 return Response::notFound(404, 'User not found');
            }
            return Response::success(200, 'User retrieved successfully', ['user' => $user], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, User retrieval failed', 500);
        }
    }

    public function store(UserRequest $request)
    {
        try {
            $user = User::create($request->all());
            return Response::success(201, 'User created successfully', ['user' => $user]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, User creation failed');
        }
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
            return Response::success(200, 'User updated successfully', ['user' => $user]);
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
            return Response::success(200, 'User deleted successfully', ['user' => $user]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, User deletion failed');
        }
    }
}
