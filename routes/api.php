<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Backend\FacultyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Backend\EnrollmentController;

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LibraryBookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\HostelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\HostelAllocationController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\TransportAllocationController;


Route::apiResource('users', UserController::class);
Route::apiResource('students', StudentController::class);
Route::apiResource('faculties', FacultyController::class);
Route::apiResource('departments', DepartmentController::class);
Route::apiResource('programs', ProgramController::class);
Route::apiResource('courses', CourseController::class);
Route::apiResource('enrollments', EnrollmentController::class);

Route::apiResource('attendances', AttendanceController::class);
Route::apiResource('exams', ExamController::class);
Route::apiResource('results', ResultController::class);
Route::apiResource('fees', FeeController::class);
Route::apiResource('payments', PaymentController::class);
Route::apiResource('events', EventController::class);
Route::apiResource('library-books', LibraryBookController::class);
Route::apiResource('borrows', BorrowController::class);
Route::apiResource('hostels', HostelController::class);
Route::apiResource('rooms', RoomController::class);
Route::apiResource('hostel-allocations', HostelAllocationController::class);
Route::apiResource('transports', TransportController::class);
Route::apiResource('transport-allocations', TransportAllocationController::class);