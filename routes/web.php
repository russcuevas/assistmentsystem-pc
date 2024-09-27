<?php

use App\Http\Controllers\admin\CourseController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ExaminersController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\users\InformationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// ADMIN AUTH PAGE
Route::get('/admin/admin_login', [AuthController::class, 'AdminLoginPage'])->name('admin.login.page');
Route::post('/admin/login_request', [AuthController::class, 'AdminLoginRequest'])->name('admin.login.request');
Route::get('/admin/logout', [AuthController::class, 'AdminLogout'])->name('admin.logout.request');


// ADMIN ROUTE
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'AdminDashboardPage'])->name('admin.dashboard.page');

    // EXAMINERS PAGE ADMIN
    Route::get('/admin/examiners', [ExaminersController::class, 'ExaminersPage'])->name('admin.examiners.page');
    Route::post('/admin/add_examiners', [ExaminersController::class, 'ExaminersAccountAdd'])->name('admin.add.examiners');

    // COURSE PAGE ADMIN
    Route::get('/admin/course', [CourseController::class, 'CoursePage'])->name('admin.course.page');
    Route::post('/admin/add_course', [CourseController::class, 'AddCourse'])->name('admin.add.course');
    Route::delete('/admin/delete_course/{id}', [CourseController::class, 'DeleteCourse'])->name('admin.delete.course');
});



// USERS AUTH PAGE
Route::get('/login', [AuthController::class, 'ExamineesLoginPage'])->name('users.login.page');
Route::post('/login_request', [AuthController::class, 'ExamineesLoginRequest'])->name('users.login.request');
Route::get('/logout', [AuthController::class, 'ExamineesLogout'])->name('users.logout.request');

// USERS ROUTE
Route::middleware(['users'])->group(function () {
    Route::get('/examinees/landing_page', [InformationController::class, 'ExamineesInformationPage'])->name('users.information.page');
});
