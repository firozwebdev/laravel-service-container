<?php

namespace App\Http\Controllers;

use App\Models\Profile;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Frs\LaravelMassCrudGenerator\Utils\Response;
use Frs\LaravelMassCrudGenerator\Utils\Helper;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function index()
    {
        try {
            $profiles = Profile::paginate(10);
            $metaData = Helper::getMetaData($profiles);
            return Response::success(200, 'Profile retrieved successfully', ['profiles' => $profiles->items()], $metaData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
        try {
            $profile = Profile::find($id);
            if (!$profile) {
                 return Response::notFound(404, 'Profile not found');
            }
            return Response::success(200, 'Profile retrieved successfully', ['profile' => $profile], $metaData = []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError('Sorry, Profile retrieval failed', 500);
        }
    }

    public function store(ProfileRequest $request)
    {
        try {
            $profile = Profile::create($request->all());
            return Response::success(201, 'Profile created successfully', ['profile' => $profile]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Profile creation failed');
        }
    }

    public function update(ProfileRequest $request, string $id)
    {
        try {
            $profile = Profile::find($id);
            if (!$profile) {
                 return Response::notFound(404, 'Profile not found');
            }
            $validatedData = $request->validated(); // Ensure validation is performed

            $profile->update($validatedData);
            return Response::success(200, 'Profile updated successfully', ['profile' => $profile]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Profile updating failed');
        }
    }

    public function destroy(string $id)
    {
        try {
            $profile = Profile::find($id);
            if (!$profile) {
                return Response::notFound(404, 'Profile not found');
            }

            $profile->delete();
            return Response::success(200, 'Profile deleted successfully', ['profile' => $profile]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return Response::serverError(500, 'Sorry, Profile deletion failed');
        }
    }
}
