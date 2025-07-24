<?php

use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherQuestionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return view('welcome');
})->middleware('testInProgress');

Route::get('/dashboard', [DashboardController::class, 'index'])
->middleware(['auth', 'verified', 'testInProgress'])->name('dashboard');

Route::middleware(['auth', 'testInProgress'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::patch('/users/{user}/ban', [UserController::class, 'ban'])->name('admin.users.ban');
    Route::patch('/users/{user}/promote', [UserController::class, 'promote'])->name('admin.users.promote');
    Route::get('/questions', [QuestionController::class, 'index'])->name('admin.questions.index');
    Route::get('/questions/{question}/edit', [QuestionController::class, 'edit'])->name('admin.questions.edit');
    Route::put('/questions/{question}', [QuestionController::class, 'update'])->name('admin.questions.update');
    Route::patch('/questions/{question}/ban', [QuestionController::class, 'ban'])->name('admin.questions.ban');
    Route::delete('/questions/{question}', [QuestionController::class, 'delete'])->name('admin.questions.delete');
});

Route::middleware(['auth', 'role:nastavnik'])->prefix('nastavnik')->group(function () {
    Route::get('/questions', [TeacherQuestionController::class, 'index'])->name('teacher.questions.index');
    Route::get('/questions/create', [TeacherQuestionController::class, 'create'])->name('teacher.questions.create');
    Route::post('/questions', [TeacherQuestionController::class, 'store'])->name('teacher.questions.store');
    Route::get('/questions/{question}/edit', [TeacherQuestionController::class, 'edit'])->name('teacher.questions.edit');
    Route::put('/questions/{question}', [TeacherQuestionController::class, 'update'])->name('teacher.questions.update');
});

Route::middleware(['auth', 'role:student'])->prefix('student')->group(function () {
    Route::get('/student/test/start', [StudentController::class, 'start'])->name('student.test.start');
    Route::post('/student/test/submit', [StudentController::class, 'submit'])->name('student.test.submit');
    Route::get('/test/results', [StudentController::class, 'results'])->name('student.test.results');
});

require __DIR__.'/auth.php';
