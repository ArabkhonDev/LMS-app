<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/courses', [CourseController::class, 'index']);
    Route::post('/courses', [CourseController::class, 'store']);
    Route::put('/courses/{course}', [CourseController::class, 'update']);
    Route::delete('/courses/{course}', [CourseController::class, 'destroy']);

    Route::get('/courses/{course}/lessons', [LessonController::class, 'index']);
    Route::post('/courses/{course}/lessons', [LessonController::class, 'store']);
    Route::put('/lessons/{lesson}', [LessonController::class, 'update']);
    Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy']);
      // Homework (uy vazifasi)
      Route::post('/lessons/{lesson}/homework', [HomeworkController::class, 'store']);
      Route::get('/lessons/{lesson}/homework', [HomeworkController::class, 'index']);
  
      // Submission (talabaning topshirishi)
      Route::post('/homework/{homework}/submit', [SubmissionController::class, 'store']);
      Route::post('/submission/{submission}/grade', [SubmissionController::class, 'grade']);
});
require __DIR__.'/auth.php';
