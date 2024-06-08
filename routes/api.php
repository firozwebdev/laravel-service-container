<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CustomerController;

Route::apiResource('payments', PaymentController::class);
Route::apiResource('customers', CustomerController::class);






