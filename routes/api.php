<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\UserController;

Route::apiResource('categories', CategoryController::class);
Route::apiResource('posts', PostController::class);
Route::apiResource('orders', OrderController::class);
Route::apiResource('contacts', ContactController::class);
Route::apiResource('users', UserController::class);