<?php

use App\Http\Controllers\LyricController;
use App\Http\Controllers\Professional\ResumeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('/track/video/{id}', 'VideoController@create');

// Route group prefixed by "professional", first route is get on /resume which uses ResumeController at invote
Route::prefix('professional')->group(function () {
    Route::get('/resume', [ResumeController::class, '__invoke']);
    Route::get('/resumes', [ResumeController::class, 'index']);
    Route::get('/resumes/{resume}', [ResumeController::class, 'show']);
});

Route::get('/lyrics/{song}', [LyricController::class, '__invoke'])->name('lyrics.show');