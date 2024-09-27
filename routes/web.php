<?php

use App\Http\Controllers\admin\CourseController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ExaminersController;
use App\Http\Controllers\admin\QuestionnaireController;
use App\Http\Controllers\admin\RiasecController;
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
    Route::delete('/admin/examiners_account/delete/{default_id}', [ExaminersController::class, 'ExaminersDefaultIdDelete'])->name('admin.delete.examiners');

    // RIASEC PAGE ADMIN
    Route::get('/admin/riasec', [RiasecController::class, 'RiasecPage'])->name('admin.riasec.page');

    
    // COURSE PAGE ADMIN
    Route::get('/admin/course', [CourseController::class, 'CoursePage'])->name('admin.course.page');
    Route::post('/admin/add_course', [CourseController::class, 'AddCourse'])->name('admin.add.course');
    Route::delete('/admin/delete_course/{id}', [CourseController::class, 'DeleteCourse'])->name('admin.delete.course');

    // QUESTION PAGE ADMIN
    Route::get('/admin/questionnaire', [QuestionnaireController::class, 'QuestionnairePage'])->name('admin.questionnaire.page');
    Route::post('/admin/add_questionnaire', [QuestionnaireController::class, 'AddQuestionnaire'])->name('admin.add.questionnaire');
    Route::get('/admin/edit/questionnaire/{id}', [QuestionnaireController::class, 'EditQuestionnaire'])->name('admin.edit.questionnaire');
    Route::post('/admin/update/questionnaire/{id}', [QuestionnaireController::class, 'UpdateQuestionnaire'])->name('admin.update.questionnaire');
    Route::post('/admin/delete/questionnaire/{id}', [QuestionnaireController::class, 'DeleteQuestionnaire'])->name('admin.delete.questionnaire');


});



// USERS AUTH PAGE
Route::get('/login', [AuthController::class, 'ExamineesLoginPage'])->name('users.login.page');
Route::post('/login_request', [AuthController::class, 'ExamineesLoginRequest'])->name('users.login.request');
Route::get('/logout', [AuthController::class, 'ExamineesLogout'])->name('users.logout.request');

// USERS ROUTE
Route::middleware(['users'])->group(function () {
    Route::get('/examinees/landing_page', [InformationController::class, 'ExaminersInformationPage'])->name('users.information.page');
    Route::post('/examinees/add_information', [InformationController::class, 'AddInformation'])->name('users.add.information');    
});
