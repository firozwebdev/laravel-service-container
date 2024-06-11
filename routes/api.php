<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\Frontend\EmployeeController;

Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('posts', PostController::class);
Route::apiResource('contacts', ContactController::class);
Route::apiResource('tasks', TaskController::class);
Route::apiResource('suppliers', SupplierController::class);
Route::apiResource('employees', EmployeeController::class);