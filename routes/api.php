<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\Frontend\EmployeeController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetTypeController;
use App\Http\Controllers\AssetCategoryController;
use App\Http\Controllers\AssetMaintenanceController;

Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('posts', PostController::class);
Route::apiResource('contacts', ContactController::class);
Route::apiResource('tasks', TaskController::class);
Route::apiResource('suppliers', SupplierController::class);
Route::apiResource('employees', EmployeeController::class);
Route::apiResource('assets', AssetController::class);
Route::apiResource('asset-types', AssetTypeController::class);
Route::apiResource('asset-categories', AssetCategoryController::class);
Route::apiResource('asset-maintenances', AssetMaintenanceController::class);