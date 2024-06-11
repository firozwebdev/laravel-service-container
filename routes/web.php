<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\SupperlierController;
use App\Http\Controllers\SupplierController;


Route::resource('categories', CategoryController::class);
Route::resource('posts', PostController::class);
Route::resource('orders', OrderController::class);
Route::resource('contacts', ContactController::class);
Route::resource('users', UserController::class);
Route::resource('products', ProductController::class);
Route::resource('supperliers', SupperlierController::class);
Route::resource('suppliers', SupplierController::class);
