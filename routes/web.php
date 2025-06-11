<?php

use Illuminate\Support\Facades\Route;


/* Student Routes */

Route::get('/', function () {
    return view('student.login.login');
})->name('login');

Route::get('/registration', function () {
    return view('student.login.registration');
})->name('registration');

Route::get('/student_dashboard', function () {
    return view('student.dashboard.dashboard');
})->name('student_dashboard');

Route::get('/student_evaluation', function () {
    return view('student.evaluation.evaluation');
})->name('student_evaluation');

Route::get('/student_evaluation_form', function () {
    return view('student.evaluation.evaluation_form');
})->name('student_evaluation_form');

Route::get('/student_history', function () {
    return view('student.history.history');
})->name('student_history');

Route::get('/student_profile', function () {
    return view('student.profile.profile');
})->name('student_profile');


/* Admin Routes */

Route::get('/admin_loginx', function () {
    return view('admin.login.login');
})->name('admin_loginx');

Route::get('/admin_dashboard', function () {
    return view('admin.dashboard.dashboard');
})->name('admin_dashboard');

Route::get('/pending_account', function () {
    return view('admin.student_management.pending_account');
})->name('pending_account');

Route::get('/approved_account', function () {
    return view('admin.student_management.approved_account');
})->name('approved_account');

Route::get('/cancelled_account', function () {
    return view('admin.student_management.cancelled_account');
})->name('cancelled_account');

Route::get('/teacher_management', function () {
    return view('admin.teacher_management.teacher_management');
})->name('teacher_management');

Route::get('/program_management', function () {
    return view('admin.program_management.program_management');
})->name('program_management');

Route::get('/subject_management', function () {
    return view('admin.subject_management.subject_management');
})->name('subject_management');

Route::get('/category_management', function () {
    return view('admin.category_management.category_management');
})->name('category_management');

Route::get('/facetoface_question', function () {
    return view('admin.evaluation_management.facetoface_question');
})->name('facetoface_question');

Route::get('/online_question', function () {
    return view('admin.evaluation_management.online_question');
})->name('online_question');

Route::get('/subject_matter_question', function () {
    return view('admin.evaluation_management.subject_matter_question');
})->name('subject_matter_question');

Route::get('/evaluation_result', function () {
    return view('admin.evaluation_result.evaluation_result');
})->name('evaluation_result');