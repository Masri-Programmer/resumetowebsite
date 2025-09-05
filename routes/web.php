<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResumeImportController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/resume/import', [ResumeImportController::class, 'store'])->middleware(['auth', 'verified'])->name('resume.import');

Route::get('/settings/language', function () {
    return Inertia::render('settings/Language');
})->middleware(['auth', 'verified'])->name('settings.language');

Route::get('/language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'de'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('language.switch');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
