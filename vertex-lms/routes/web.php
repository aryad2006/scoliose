<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Course Pages
    Route::get('/courses', [\App\Http\Controllers\CoursePageController::class, 'index'])->name('frontend.courses.index');
    Route::get('/courses/{course:slug}', [\App\Http\Controllers\CoursePageController::class, 'show'])->name('frontend.courses.show');

    // Lesson Pages
    Route::get('/lessons/{lesson}', [\App\Http\Controllers\LessonPageController::class, 'show'])->name('frontend.lessons.show');
});

// API Routes for VERTEX LMS
Route::middleware('auth')->prefix('api')->group(function () {
    // Courses
    Route::apiResource('courses', \App\Http\Controllers\CourseController::class);

    // Modules under Courses
    Route::apiResource('courses.modules', \App\Http\Controllers\ModuleController::class)->shallow();

    // Lessons under Modules
    Route::apiResource('modules.lessons', \App\Http\Controllers\LessonController::class)->shallow();

    // Enrollment (student joins a course)
    Route::post('courses/{course}/enroll', [\App\Http\Controllers\EnrollmentController::class, 'store'])->name('enroll');
    Route::get('enrollments', [\App\Http\Controllers\EnrollmentController::class, 'index'])->name('enrollments.index');
    Route::delete('courses/{course}/unenroll', [\App\Http\Controllers\EnrollmentController::class, 'destroy'])->name('unenroll');

    // Progress (track lesson completion)
    Route::post('lessons/{lesson}/progress', [\App\Http\Controllers\ProgressController::class, 'store'])->name('progress.store');
    Route::get('lessons/{lesson}/progress', [\App\Http\Controllers\ProgressController::class, 'show'])->name('progress.show');
    Route::get('courses/{course}/progress', [\App\Http\Controllers\ProgressController::class, 'coursesProgress'])->name('progress.course');

    // Media (upload and manage lesson media)
    Route::get('lessons/{lesson}/media', [\App\Http\Controllers\MediaController::class, 'index'])->name('media.index');
    Route::post('lessons/{lesson}/media', [\App\Http\Controllers\MediaController::class, 'store'])->name('media.store');
    Route::delete('lessons/{lesson}/media/{media}', [\App\Http\Controllers\MediaController::class, 'destroy'])->name('media.destroy');
});

require __DIR__.'/auth.php';
