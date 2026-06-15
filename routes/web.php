<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Manager\LearningMaterialController;
use App\Http\Controllers\Manager\ScheduleController;
use App\Http\Controllers\Manager\StudentController;
use App\Http\Controllers\Manager\TeacherController;
use App\Http\Controllers\Manager\TeachingHistoryManagerController;
use App\Http\Controllers\Student\LearningHistoryController;
use App\Http\Controllers\Student\MaterialDownloadController;
use App\Http\Controllers\Teacher\TeachingHistoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // -------------------------
    // Manager routes
    // -------------------------
    Route::middleware(['role:manager'])->prefix('manager')->name('manager.')->group(function () {
        // Teachers
        Route::resource('teachers', TeacherController::class);

        // Students
        Route::resource('students', StudentController::class);

        // Schedules
        Route::resource('schedules', ScheduleController::class)->except(['show']);

        // Learning materials
        Route::resource('materials', LearningMaterialController::class)->except(['show']);
        Route::get('materials/{material}/download', [LearningMaterialController::class, 'download'])
            ->name('materials.download');

        // Teaching histories (view/manage all)
        Route::resource('histories', TeachingHistoryManagerController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
        Route::get('histories/{history}/video', [TeachingHistoryManagerController::class, 'downloadVideo'])->name('histories.video');
    });

    // -------------------------
    // Teacher routes
    // -------------------------
    Route::middleware(['role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
        Route::get('/', [TeachingHistoryController::class, 'dashboard'])->name('dashboard');
        Route::resource('histories', TeachingHistoryController::class);
        Route::get('histories/{history}/video', [TeachingHistoryController::class, 'downloadVideo'])->name('histories.video');
    });

    // -------------------------
    // Student routes
    // -------------------------
    Route::middleware(['role:student'])->prefix('student')->name('student.')->group(function () {
        Route::get('/', [LearningHistoryController::class, 'dashboard'])->name('dashboard');
        Route::get('history', [LearningHistoryController::class, 'index'])->name('history.index');
        Route::get('history/{history}', [LearningHistoryController::class, 'show'])->name('history.show');
        Route::get('history/{history}/video', [LearningHistoryController::class, 'downloadVideo'])->name('history.video');
        Route::get('materials', [MaterialDownloadController::class, 'index'])->name('materials.index');
        Route::get('materials/{material}/download', [MaterialDownloadController::class, 'download'])
            ->name('materials.download');
    });
});

require __DIR__ . '/auth.php';
