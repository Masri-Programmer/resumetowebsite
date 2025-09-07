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
    Route::get('/dashboard', [ResumeController::class, 'dashboard'])->name('dashboard');
    Route::prefix('dashboard')->group(function () {
        Route::resource('resumes', ResumeController::class);
        Route::post('resume/import', [ResumeController::class, 'import'])->name('import');
    });
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::inertia('/language', 'settings/Language')->name('language');
    });
});

require __DIR__ . '/auth.php';
require __DIR__ . '/settings.php';
