<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;

Route::apiResource('tasks', TaskController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('posts', PostController::class);






