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
use App\Http\Controllers\AssetController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PaymnetController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PaymentController;


Route::resource('categories', CategoryController::class);
Route::resource('posts', PostController::class);
Route::resource('orders', OrderController::class);
Route::resource('contacts', ContactController::class);
Route::resource('users', UserController::class);
Route::resource('products', ProductController::class);
Route::resource('supperliers', SupperlierController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('assets', AssetController::class);
Route::resource('reminders', ReminderController::class);
Route::resource('assignments', AssignmentController::class);
Route::resource('students', StudentController::class);
Route::resource('customers', CustomerController::class);
Route::resource('order-items', OrderItemController::class);
Route::resource('paymnets', PaymnetController::class);
Route::resource('tests', TestController::class);
Route::resource('payments', PaymentController::class);
