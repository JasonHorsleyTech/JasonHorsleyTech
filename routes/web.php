<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\LinkedinPostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomepageController::class);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/linkedin-posts', LinkedinPostController::class)->only(['index', 'destroy']);
});

Route::get('/linkedin/redirect', [LoginController::class, 'redirectToLinkedIn'])->name('linkedin.redirect');
Route::get('/linkedin/callback', [LoginController::class, 'handleLinkedInCallback']);
Route::get('/linkedin-privacy-policy', function () {
    return Inertia::render('LinkedinPrivacyPolicy');
})->name('linkedin-privacy-policy');

Route::get('/cowboy-coders', function () {
    return Inertia::render('CowboyCoders');
})->name('cowboy-coders');

require __DIR__ . '/auth.php';
