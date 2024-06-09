<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OpportunityController;

Route::apiResource('categories', CategoryController::class);
Route::apiResource('posts', PostController::class);
Route::apiResource('tasks', TaskController::class);
Route::apiResource('contacts', ContactController::class);
Route::apiResource('opportunities', OpportunityController::class);