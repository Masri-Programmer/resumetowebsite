<?php

use App\Http\Controllers\PublicResumeController;
use App\Http\Controllers\ResumeController;
use Illuminate\Support\Facades\Route;
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

// Route::domain('{subdomain}.resumetowebsite.masri.blog')->group(function () {
//     Route::get('/', [PublicResumeController::class, 'show'])->name('resume.public.show');
// });
// Route::domain('{subdomain}.resumetowebsite.test')->group(function () {
//     Route::get('/', [PublicResumeController::class, 'show'])->name('resume.public.show');
// });

require __DIR__ . '/auth.php';
require __DIR__ . '/settings.php';
