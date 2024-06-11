<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Frontend\PostController;


Route::resource('categories', CategoryController::class);
Route::resource('posts', PostController::class);
