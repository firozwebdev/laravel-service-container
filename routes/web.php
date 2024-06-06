<?php

use App\Test\Greeting;
use App\Test\Postcard;
use Illuminate\Support\Str;
use App\Test\PostcardSedingService;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\ProfileController;
use Doctrine\Inflector\InflectorFactory;
use Frs\LaravelMassCrudGenerator\Utils\ResponseUtlity;

Route::get('/', function () {
    //return InflectorFactory::create()->build()->pluralize('box');
    //return Str::plural('category');
   //dd(\Illuminate\Support\Str::partNumber('123458545623'));
   //dd(\Illuminate\Support\Str::prefix('123458545623'));
    //return Response::errorJson();
    // $greeting = new Greeting('John');
    // return $greeting->greet('AstalabistaBaby');
    
   
});


Route::get('/postcards', function () {
    $postcardService = new PostcardSedingService('us','4','6');
    $postcardService->hello('Message from frsweb\'s postcard service','test@example.com');
});

Route::get('/facades', function () {
   Postcard::hello('hello world','test@example.com');
});



Route::get('/users',[UserController::class,'index'])->name('user.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
