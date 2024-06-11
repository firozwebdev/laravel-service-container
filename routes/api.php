<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetTypeController;
use App\Http\Controllers\AssetCategoryController;
use App\Http\Controllers\AssetMaintenanceController;
use App\Http\Controllers\AssetDepreciationController;
use App\Http\Controllers\AssetLocationController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AssetPurchaseOrderController;
use App\Http\Controllers\PurchaseOrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;

Route::apiResource('assets', AssetController::class);
Route::apiResource('asset-types', AssetTypeController::class);
Route::apiResource('asset-categories', AssetCategoryController::class);
Route::apiResource('asset-maintenances', AssetMaintenanceController::class);
Route::apiResource('asset-depreciations', AssetDepreciationController::class);
Route::apiResource('asset-locations', AssetLocationController::class);
Route::apiResource('suppliers', SupplierController::class);
Route::apiResource('asset-purchase-orders', AssetPurchaseOrderController::class);
Route::apiResource('purchase-order-items', PurchaseOrderItemController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('posts', PostController::class);