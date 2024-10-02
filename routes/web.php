<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AnalyticsController;
use App\Http\Controllers\admin\CourseController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ExaminersController;
use App\Http\Controllers\admin\QuestionnaireController;
use App\Http\Controllers\admin\RiasecController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\users\ExaminationController;
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

    // ADMIN MANAGEMENT PAGE ADMIN
    Route::get('/admin/admin_management', [AdminController::class, 'AdminManagementPage'])->name('admin.admin.management.page');
    Route::post('/admin/add_admin', [AdminController::class, 'AddAdmin'])->name('admin.add.admin');
    Route::put('/admin/update/admin/{id}', [AdminController::class, 'UpdateAdmin'])->name('admin.update.admin');
    Route::delete('/admin/delete/admin/{id}', [AdminController::class, 'DeleteAdmin'])->name('admin.delete.admin');



    // EXAMINERS PAGE ADMIN
    Route::get('/admin/examiners', [ExaminersController::class, 'ExaminersPage'])->name('admin.examiners.page');
    Route::post('/admin/add_examiners', [ExaminersController::class, 'ExaminersAccountAdd'])->name('admin.add.examiners');
    Route::delete('/admin/examiners_account/delete/{default_id}', [ExaminersController::class, 'ExaminersDefaultIdDelete'])->name('admin.delete.examiners');
    Route::delete('/admin/examiners_list/delete/{id}', [ExaminersController::class, 'ExaminersListDelete'])->name('admin.delete.examiners.list');

    // RIASEC PAGE ADMIN
    Route::get('/admin/riasec', [RiasecController::class, 'RiasecPage'])->name('admin.riasec.page');
    Route::post('/admin/add_riasec', [RiasecController::class, 'AddRiasec'])->name('admin.add.riasec');
    Route::get('/admin/edit/riasec/{id}', [RiasecController::class, 'EditRiasec'])->name('admin.edit.riasec');
    Route::put('/admin/update/riasec/{id}', [RiasecController::class, 'UpdateRiasec'])->name('admin.update.riasec');
    Route::delete('/admin/delete/riasec/{id}', [RiasecController::class, 'DeleteRiasec'])->name('admin.delete.riasec');




    // COURSE PAGE ADMIN
    Route::get('/admin/course', [CourseController::class, 'CoursePage'])->name('admin.course.page');
    Route::post('/admin/add_course', [CourseController::class, 'AddCourse'])->name('admin.add.course');
    Route::put('admin/update/course/{id}', [CourseController::class, 'UpdateCourse'])->name('admin.update.course');
    Route::delete('/admin/delete_course/{id}', [CourseController::class, 'DeleteCourse'])->name('admin.delete.course');

    // QUESTION PAGE ADMIN
    Route::get('/admin/questionnaire', [QuestionnaireController::class, 'QuestionnairePage'])->name('admin.questionnaire.page');
    Route::post('/admin/add_questionnaire', [QuestionnaireController::class, 'AddQuestionnaire'])->name('admin.add.questionnaire');
    Route::get('/admin/edit/questionnaire/{id}', [QuestionnaireController::class, 'EditQuestionnaire'])->name('admin.edit.questionnaire');
    Route::put('/admin/update/questionnaire/{id}', [QuestionnaireController::class, 'UpdateQuestionnaire'])->name('admin.update.questionnaire');
    Route::post('/admin/delete/questionnaire/{id}', [QuestionnaireController::class, 'DeleteQuestionnaire'])->name('admin.delete.questionnaire');

    // ANALYTICS PAGE ADMIN
    Route::get('/admin/analytics', [AnalyticsController::class, 'AnalyticsPage'])->name('admin.analytics.page');
    Route::get('/admin/examiners/data-gender', [AnalyticsController::class, 'GetExaminersDataByGender']);
    Route::get('/admin/courses/offered', [AnalyticsController::class, 'GetOfferedCourses']);
});



// USERS AUTH PAGE
Route::get('/login', [AuthController::class, 'ExamineesLoginPage'])->name('users.login.page');
Route::post('/login_request', [AuthController::class, 'ExamineesLoginRequest'])->name('users.login.request');
Route::get('/logout', [AuthController::class, 'ExamineesLogout'])->name('users.logout.request');

// USERS ROUTE
Route::middleware(['users'])->group(function () {
    // EXAMINATION INFORMATION PAGE
    Route::get('/examinees/landing_page', [InformationController::class, 'ExaminersInformationPage'])->name('users.information.page');
    Route::post('/examinees/add_information', [InformationController::class, 'AddInformation'])->name('users.add.information');

    // EXAMINATION FORM PAGE
    Route::get('/examinees/examination', [ExaminationController::class, 'ExaminationPage'])->name('users.examination.page');
    Route::post('/examinees/submit_responses', [ExaminationController::class, 'SubmitResponses'])->name('users.submit.responses');
    Route::get('/examinees/completed', [ExaminationController::class, 'ExaminationCompletedPage'])->name('users.completed.page');
});