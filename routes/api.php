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

Route::post('/test', function (Request $request) {
    $conversationId = $request->input('id');
    $userName = $request->input('name');
    $liveChatUrl = $request->input('live_chat_url');
    $lastTextInput = $request->input('last_input_text');

    info('new request');
    info($conversationId);
    info($userName);
    info($liveChatUrl);
    info($lastTextInput);

    // 'user_still_responding' | 'gpt_follow_up_question' | 'gpt_closing_remark'
    $step = 'user_still_responding';

    if ($step === 'user_still_responding') {
        return response()->json([
            'version' => 'v2',
            'content' => [
                "gpt_response_to_user" => null,
                "topic_finished" => false,
                "user_still_responding" => true,
            ]
        ]);
    }

    if ($step === 'gpt_follow_up_question') {
        return response()->json([
            'version' => 'v2',
            'content' => [
                "gpt_response_to_user" => 'Can you elaborate',
                "topic_finished" => false,
                "user_still_responding" => true,
            ]
        ]);
    }

    if ($step === 'gpt_closing_remark') {
        return response()->json([
            'version' => 'v2',
            'content' => [
                "gpt_response_to_user" => 'OK, understood',
                "topic_finished" => true,
                "user_still_responding" => false,
            ]
        ]);
    }
});
