<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Manager\LearningMaterialController;
use App\Http\Controllers\Manager\MaterialCategoryController;
use App\Http\Controllers\Manager\ScheduleController;
use App\Http\Controllers\Manager\StudentController;
use App\Http\Controllers\Manager\TeacherController;
use App\Http\Controllers\Manager\TeachingHistoryManagerController;
use App\Http\Controllers\Student\LearningHistoryController;
use App\Http\Controllers\Student\MaterialDownloadController;
use App\Http\Controllers\Teacher\TeacherMaterialController;
use App\Http\Controllers\Teacher\TeachingHistoryController;
use App\Http\Controllers\ViceManager\LearningMaterialController as VMLearningMaterialController;
use App\Http\Controllers\ViceManager\MaterialCategoryController as VMMaterialCategoryController;
use App\Http\Controllers\ViceManager\ScheduleController as VMScheduleController;
use App\Http\Controllers\ViceManager\StudentController as VMStudentController;
use App\Http\Controllers\ViceManager\TeacherController as VMTeacherController;
use App\Http\Controllers\ViceManager\TeachingHistoryController as VMTeachingHistoryController;
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

        // Material categories (nested under materials/ for clarity)
        Route::prefix('materials')->name('materials.')->group(function () {
            Route::resource('categories', MaterialCategoryController::class)->except(['show'])
                ->parameters(['categories' => 'category']);
        });

        // Learning materials
        Route::resource('materials', LearningMaterialController::class)->except(['show']);
        Route::get('materials/{material}/download', [LearningMaterialController::class, 'download'])
            ->name('materials.download');

        // Teaching histories (view/manage all)
        Route::resource('histories', TeachingHistoryManagerController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
        Route::get('histories/{history}/video', [TeachingHistoryManagerController::class, 'downloadVideo'])->name('histories.video');
        Route::get('histories/{history}/stream', [TeachingHistoryManagerController::class, 'streamVideo'])->name('histories.stream');
    });

    // -------------------------
    // Vice Manager routes
    // -------------------------
    Route::middleware(['role:vice-manager'])->prefix('vice-manager')->name('vice-manager.')->group(function () {
        Route::get('/', fn() => redirect()->route('dashboard'))->name('home');
        Route::resource('teachers', VMTeacherController::class)->only(['index', 'show']);
        Route::resource('students', VMStudentController::class)->only(['index', 'show']);
        Route::get('schedules', [VMScheduleController::class, 'index'])->name('schedules.index');
        Route::get('histories', [VMTeachingHistoryController::class, 'index'])->name('histories.index');
        Route::get('histories/{history}', [VMTeachingHistoryController::class, 'show'])->name('histories.show');
        Route::get('histories/{history}/video', [VMTeachingHistoryController::class, 'downloadVideo'])->name('histories.video');
        Route::get('histories/{history}/stream', [VMTeachingHistoryController::class, 'streamVideo'])->name('histories.stream');
        Route::prefix('materials')->name('materials.')->group(function () {
            Route::get('categories', [VMMaterialCategoryController::class, 'index'])->name('categories.index');
        });
        Route::get('materials', [VMLearningMaterialController::class, 'index'])->name('materials.index');
        Route::get('materials/{material}/download', [VMLearningMaterialController::class, 'download'])->name('materials.download');
    });

    // -------------------------
    // Teacher routes
    // -------------------------
    Route::middleware(['role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
        Route::get('/', [TeachingHistoryController::class, 'dashboard'])->name('dashboard');
        Route::resource('histories', TeachingHistoryController::class);
        Route::get('histories/{history}/video', [TeachingHistoryController::class, 'downloadVideo'])->name('histories.video');
        Route::get('histories/{history}/stream', [TeachingHistoryController::class, 'streamVideo'])->name('histories.stream');
        Route::get('materials', [TeacherMaterialController::class, 'index'])->name('materials.index');
        Route::get('materials/{material}/download', [TeacherMaterialController::class, 'download'])->name('materials.download');
    });

    // -------------------------
    // Student routes
    // -------------------------
    Route::middleware(['role:student'])->prefix('student')->name('student.')->group(function () {
        Route::get('/', [LearningHistoryController::class, 'dashboard'])->name('dashboard');
        Route::get('history', [LearningHistoryController::class, 'index'])->name('history.index');
        Route::get('history/{history}', [LearningHistoryController::class, 'show'])->name('history.show');
        Route::get('history/{history}/video', [LearningHistoryController::class, 'downloadVideo'])->name('history.video');
        Route::get('history/{history}/stream', [LearningHistoryController::class, 'streamVideo'])->name('history.stream');
        Route::get('materials', [MaterialDownloadController::class, 'index'])->name('materials.index');
        Route::get('materials/{material}/download', [MaterialDownloadController::class, 'download'])
            ->name('materials.download');
    });
});

require __DIR__ . '/auth.php';
