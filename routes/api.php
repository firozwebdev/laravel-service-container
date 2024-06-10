<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\UserController;

Route::apiResource('categories', CategoryController::class);
Route::apiResource('tasks', TaskController::class);
Route::apiResource('posts', PostController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('order-items', OrderItemController::class);
Route::apiResource('leads', LeadController::class);
Route::apiResource('categories', CategoriesController::class);
Route::apiResource('users', UserController::class);