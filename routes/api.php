<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;

Route::apiResource('tasks', TaskController::class);
Route::apiResource('categories', CategoryController::class);






