<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FaceToFaceQuestionController;
use App\Http\Controllers\OnlineQuestionController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectMatterQuestionController;
use App\Http\Controllers\TeacherController;

/* Student Routes */

Route::get('/', function () {
    return view('student.login.login');
})->name('login');

Route::prefix('registration')->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('registration');
    Route::post('/store', [StudentController::class, 'store'])->name('student_management_store');
    Route::post('/show', [StudentController::class, 'show'])->name('student_management_show');
    Route::post('/logout', [StudentController::class, 'logout'])->name('logout');
});

Route::middleware('StudentAuth')->get('/student_dashboard', function () {
    return view('student.dashboard.dashboard');
})->name('student_dashboard');

Route::middleware('StudentAuth')->get('/student_evaluation', function () {
    return view('student.evaluation.evaluation');
})->name('student_evaluation');

Route::middleware('StudentAuth')->get('/student_evaluation_form', function () {
    return view('student.evaluation.evaluation_form');
})->name('student_evaluation_form');

Route::middleware('StudentAuth')->get('/student_history', function () {
    return view('student.history.history');
})->name('student_history');

Route::middleware('StudentAuth')->get('/student_profile', function () {
    return view('student.profile.profile');
})->name('student_profile');


/* Admin Routes */

Route::prefix('admin_loginx')->group(function () {
    Route::get('/', [AdminLoginController::class, 'index'])->name('admin_loginx');
    Route::post('/loginx', [AdminLoginController::class, 'login'])->name('loginx');
    Route::post('/logoutx', [AdminLoginController::class, 'logout'])->name('logoutx');
});

Route::middleware('AdminAuth')->get('/admin_dashboard', function () {
    return view('admin.dashboard.dashboard');
})->name('admin_dashboard');

Route::middleware('AdminAuth')->prefix('pending_account')->group(function() {
    Route::get('/', [StudentController::class, 'pendingAccount'])->name('pending_account');
    Route::post('/update_approved', [StudentController::class, 'pendingAccountUpdateApproved'])->name('pending_account_update_approved');
    Route::post('/update_cancel', [StudentController::class, 'pendingAccountUpdateCancel'])->name('pending_account_update_cancel');
    Route::post('/update_all', [StudentController::class, 'accountUpdateAll'])->name('account_update_all');
});

Route::middleware('AdminAuth')->get('/approved_account', function () {
    return view('admin.student_management.approved_account');
})->name('approved_account');

Route::middleware('AdminAuth')->get('/cancelled_account', function () {
    return view('admin.student_management.cancelled_account');
})->name('cancelled_account');

Route::middleware('AdminAuth')->prefix('teacher_management')->group(function() {
    Route::get('/', [TeacherController::class, 'index'])->name('teacher_management');
    Route::post('/store', [TeacherController::class, 'store'])->name('teacher_management_store');
    Route::get('/edit', [TeacherController::class, 'edit'])->name('teacher_management_edit');
    Route::post('/update', [TeacherController::class, 'update'])->name('teacher_management_update');
    Route::post('/status', [TeacherController::class, 'status'])->name('teacher_management_status');
});

Route::middleware('AdminAuth')->prefix('program_management')->group(function() {
    Route::get('/', [ProgramController::class, 'index'])->name('program_management');
    Route::post('/store', [ProgramController::class, 'store'])->name('program_management_store');
    Route::get('/edit', [ProgramController::class, 'edit'])->name('program_management_edit');
    Route::post('/update', [ProgramController::class, 'update'])->name('program_management_update');
    Route::post('/status', [ProgramController::class, 'status'])->name('program_management_status');
});

Route::middleware('AdminAuth')->prefix('subject_management')->group(function() {
    Route::get('/', [SubjectController::class, 'index'])->name('subject_management');
    Route::post('/store', [SubjectController::class, 'store'])->name('subject_management_store');
    Route::get('/edit', [SubjectController::class, 'edit'])->name('subject_management_edit');
    Route::post('/update', [SubjectController::class, 'update'])->name('subject_management_update');
    Route::post('/status', [SubjectController::class, 'status'])->name('subject_management_status');
});

Route::middleware('AdminAuth')->prefix('category_management')->group(function() {
    Route::get('/', [CategoryController::class, 'index'])->name('category_management');
    Route::post('/store', [CategoryController::class, 'store'])->name('category_management_store');
    Route::get('/edit', [CategoryController::class, 'edit'])->name('category_management_edit');
    Route::post('/update', [CategoryController::class, 'update'])->name('category_management_update');
    Route::post('/status', [CategoryController::class, 'status'])->name('category_management_status');
});

Route::middleware('AdminAuth')->prefix('facetoface_question')->group(function() {
    Route::get('/', [FaceToFaceQuestionController::class, 'index'])->name('facetoface_question');
    Route::post('/store', [FaceToFaceQuestionController::class, 'store'])->name('facetoface_question_store');
    Route::get('/edit', [FaceToFaceQuestionController::class, 'edit'])->name('facetoface_question_edit');
    Route::post('/update', [FaceToFaceQuestionController::class, 'update'])->name('facetoface_question_update');
    Route::post('/status', [FaceToFaceQuestionController::class, 'status'])->name('facetoface_question_status');
});

Route::middleware('AdminAuth')->prefix('online_question')->group(function() {
    Route::get('/', [OnlineQuestionController::class, 'index'])->name('online_question');
    Route::post('/store', [OnlineQuestionController::class, 'store'])->name('online_question_store');
    Route::get('/edit', [OnlineQuestionController::class, 'edit'])->name('online_question_edit');
    Route::post('/update', [OnlineQuestionController::class, 'update'])->name('online_question_update');
    Route::post('/status', [OnlineQuestionController::class, 'status'])->name('online_question_status');
});

Route::middleware('AdminAuth')->prefix('subject_matter_question')->group(function() {
    Route::get('/', [SubjectMatterQuestionController::class, 'index'])->name('subject_matter_question');
    Route::post('/store', [SubjectMatterQuestionController::class, 'store'])->name('subject_matter_question_store');
    Route::get('/edit', [SubjectMatterQuestionController::class, 'edit'])->name('subject_matter_question_edit');
    Route::post('/update', [SubjectMatterQuestionController::class, 'update'])->name('subject_matter_question_update');
    Route::post('/status', [SubjectMatterQuestionController::class, 'status'])->name('subject_matter_question_status');
});

Route::middleware('AdminAuth')->get('/evaluation_result', function () {
    return view('admin.evaluation_result.evaluation_result');
})->name('evaluation_result');