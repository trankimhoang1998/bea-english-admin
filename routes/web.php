<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Manager\LearningMaterialController;
use App\Http\Controllers\Manager\MaterialCategoryController;
use App\Http\Controllers\Manager\ScheduleController;
use App\Http\Controllers\Manager\StudentController;
use App\Http\Controllers\Manager\TeacherController;
use App\Http\Controllers\Manager\ClassLinkController as ManagerClassLinkController;
use App\Http\Controllers\Manager\TeachingHistoryManagerController;
use App\Http\Controllers\Student\LearningHistoryController;
use App\Http\Controllers\Student\MaterialDownloadController;
use App\Http\Controllers\Teacher\ClassLinkController as TeacherClassLinkController;
use App\Http\Controllers\Teacher\TeacherMaterialController;
use App\Http\Controllers\Teacher\TeachingHistoryController;
use App\Http\Controllers\ViceManager\ClassLinkController as VMClassLinkController;
use App\Http\Controllers\ViceManager\LearningMaterialController as VMLearningMaterialController;
use App\Http\Controllers\ViceManager\MaterialCategoryController as VMMaterialCategoryController;
use App\Http\Controllers\ViceManager\ScheduleController as VMScheduleController;
use App\Http\Controllers\ViceManager\StudentController as VMStudentController;
use App\Http\Controllers\ViceManager\TeacherController as VMTeacherController;
use App\Http\Controllers\ViceManager\TeachingHistoryController as VMTeachingHistoryController;
use App\Http\Controllers\Manager\ArticleCategoryController;
use App\Http\Controllers\Manager\ArticleTagController as ManagerArticleTagController;
use App\Http\Controllers\Manager\ArticleController as ManagerArticleController;
use App\Http\Controllers\ViceManager\ArticleController as VMArticleController;
use App\Http\Controllers\ViceManager\ArticleCategoryController as VMArticleCategoryController;
use App\Http\Controllers\ViceManager\ArticleTagController as VMArticleTagController;
use Illuminate\Support\Facades\Route;

Route::get('/',                        [HomeController::class, 'index'])->name('home');
Route::get('/gioi-thieu',              [HomeController::class, 'gioiThieu'])->name('home.gioi-thieu');
Route::get('/phuong-phap',             [HomeController::class, 'phuongPhap'])->name('home.phuong-phap');
Route::get('/tieng-anh-hoc-sinh',      [HomeController::class, 'khoaHoc'])->name('home.khoa-hoc');
Route::get('/tieng-anh-nguoi-lon',     [HomeController::class, 'nguoiLon'])->name('home.nguoi-lon');
Route::get('/luyen-thi-ielts',         [HomeController::class, 'luyenThiIelts'])->name('home.ielts');
Route::get('/tin-tuc',                 [HomeController::class, 'tinTuc'])->name('home.tin-tuc');
Route::get('/tin-tuc/{slug}',          [HomeController::class, 'articleDetail'])->name('home.article-detail');
Route::get('/sitemap.xml',             [HomeController::class, 'sitemap'])->name('sitemap');

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
        Route::delete('histories/{history}/video', [TeachingHistoryManagerController::class, 'deleteVideo'])->name('histories.deleteVideo');

        // Class links
        Route::resource('class-links', ManagerClassLinkController::class)->only(['index', 'update', 'destroy']);

        // Article categories & tags (nested under articles/ for clarity)
        Route::prefix('articles')->name('articles.')->group(function () {
            Route::resource('categories', ArticleCategoryController::class)->except(['show'])
                ->parameters(['categories' => 'articleCategory']);
            Route::resource('tags', ManagerArticleTagController::class)->except(['show'])
                ->parameters(['tags' => 'articleTag']);
        });

        // Articles
        Route::post('articles/upload-image', [ManagerArticleController::class, 'uploadImage'])->name('articles.upload-image');
        Route::resource('articles', ManagerArticleController::class);
    });

    // -------------------------
    // Vice Manager routes
    // -------------------------
    Route::middleware(['role:vice-manager'])->prefix('vice-manager')->name('vice-manager.')->group(function () {
        Route::get('/', fn() => redirect()->route('dashboard'));
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

        // Class links
        Route::get('class-links', [VMClassLinkController::class, 'index'])->name('class-links.index');

        Route::prefix('articles')->name('articles.')->group(function () {
            Route::get('categories', [VMArticleCategoryController::class, 'index'])->name('categories.index');
            Route::get('tags', [VMArticleTagController::class, 'index'])->name('tags.index');
        });
        Route::get('articles', [VMArticleController::class, 'index'])->name('articles.index');
        Route::get('articles/{article}', [VMArticleController::class, 'show'])->name('articles.show');
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

        // Class links
        Route::post('class-links', [TeacherClassLinkController::class, 'store'])->name('class-links.store');
        Route::put('class-links/{classLink}', [TeacherClassLinkController::class, 'update'])->name('class-links.update');
        Route::delete('class-links/{classLink}', [TeacherClassLinkController::class, 'destroy'])->name('class-links.destroy');
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
