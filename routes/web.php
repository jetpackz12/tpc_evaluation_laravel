<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FaceToFaceQuestionController;
use App\Http\Controllers\OnlineQuestionController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectMatterQuestionController;

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

Route::prefix('admin_loginx')->group(function () {
    Route::get('/', [AdminLoginController::class, 'index'])->name('admin_loginx');
    Route::post('/loginx', [AdminLoginController::class, 'login'])->name('loginx');
    Route::post('/logoutx', [AdminLoginController::class, 'logout'])->name('logoutx');
});

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

Route::prefix('program_management')->group(function() {
    Route::get('/', [ProgramController::class, 'index'])->name('program_management');
    Route::post('/store', [ProgramController::class, 'store'])->name('program_management_store');
    Route::get('/edit', [ProgramController::class, 'edit'])->name('program_management_edit');
    Route::post('/update', [ProgramController::class, 'update'])->name('program_management_update');
    Route::post('/status', [ProgramController::class, 'status'])->name('program_management_status');
});

Route::prefix('subject_management')->group(function() {
    Route::get('/', [SubjectController::class, 'index'])->name('subject_management');
    Route::post('/store', [SubjectController::class, 'store'])->name('subject_management_store');
    Route::get('/edit', [SubjectController::class, 'edit'])->name('subject_management_edit');
    Route::post('/update', [SubjectController::class, 'update'])->name('subject_management_update');
    Route::post('/status', [SubjectController::class, 'status'])->name('subject_management_status');
});

Route::prefix('category_management')->group(function() {
    Route::get('/', [CategoryController::class, 'index'])->name('category_management');
    Route::post('/store', [CategoryController::class, 'store'])->name('category_management_store');
    Route::get('/edit', [CategoryController::class, 'edit'])->name('category_management_edit');
    Route::post('/update', [CategoryController::class, 'update'])->name('category_management_update');
    Route::post('/status', [CategoryController::class, 'status'])->name('category_management_status');
});

Route::prefix('facetoface_question')->group(function() {
    Route::get('/', [FaceToFaceQuestionController::class, 'index'])->name('facetoface_question');
    Route::post('/store', [FaceToFaceQuestionController::class, 'store'])->name('facetoface_question_store');
    Route::get('/edit', [FaceToFaceQuestionController::class, 'edit'])->name('facetoface_question_edit');
    Route::post('/update', [FaceToFaceQuestionController::class, 'update'])->name('facetoface_question_update');
    Route::post('/status', [FaceToFaceQuestionController::class, 'status'])->name('facetoface_question_status');
});

Route::prefix('online_question')->group(function() {
    Route::get('/', [OnlineQuestionController::class, 'index'])->name('online_question');
    Route::post('/store', [OnlineQuestionController::class, 'store'])->name('online_question_store');
    Route::get('/edit', [OnlineQuestionController::class, 'edit'])->name('online_question_edit');
    Route::post('/update', [OnlineQuestionController::class, 'update'])->name('online_question_update');
    Route::post('/status', [OnlineQuestionController::class, 'status'])->name('online_question_status');
});

Route::prefix('subject_matter_question')->group(function() {
    Route::get('/', [SubjectMatterQuestionController::class, 'index'])->name('subject_matter_question');
    Route::post('/store', [SubjectMatterQuestionController::class, 'store'])->name('subject_matter_question_store');
    Route::get('/edit', [SubjectMatterQuestionController::class, 'edit'])->name('subject_matter_question_edit');
    Route::post('/update', [SubjectMatterQuestionController::class, 'update'])->name('subject_matter_question_update');
    Route::post('/status', [SubjectMatterQuestionController::class, 'status'])->name('subject_matter_question_status');
});

Route::get('/evaluation_result', function () {
    return view('admin.evaluation_result.evaluation_result');
})->name('evaluation_result');