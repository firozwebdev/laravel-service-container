<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Backend\PostController;

Route::apiResource('categories', CategoryController::class);
Route::apiResource('posts', PostController::class);


