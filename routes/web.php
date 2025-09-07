<?php

use App\Http\Controllers\ResumeController;
use App\Http\Controllers\ResumeImportController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::inertia('/', 'Welcome')->name('home');

Route::get('/language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'de'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->whereIn('locale', ['en', 'de'])->name('language.switch');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [ResumeController::class, 'show'])->name('index');
        Route::get('/resume', [ResumeController::class, 'show'])->name('resume');
        Route::resource('resumes', ResumeController::class)->names('resumes');
    });

    Route::prefix('resume')->name('resume.')->group(function () {
        Route::post('/import', [ResumeImportController::class, 'store'])->name('import');
        Route::post('/save', [ResumeController::class, 'store'])->name('save');
    });

    // Settings routes
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::inertia('/language', 'settings/Language')->name('language');
    });
});

require __DIR__ . '/auth.php';
require __DIR__ . '/settings.php';
