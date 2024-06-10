<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\LeadController;

Route::apiResource('categories', CategoryController::class);
Route::apiResource('tasks', TaskController::class);
Route::apiResource('posts', PostController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('order-items', OrderItemController::class);
Route::apiResource('leads', LeadController::class);