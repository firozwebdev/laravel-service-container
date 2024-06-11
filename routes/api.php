<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;

Route::apiResource('categories', CategoryController::class);