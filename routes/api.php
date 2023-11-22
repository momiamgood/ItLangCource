<?php

use App\Http\Controllers\Api\TopicController;
use App\Http\Controllers\Api\WordController;
use App\Http\Controllers\Api\WordsetController;
use App\Http\Controllers\AuthController;
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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::group([
    'middleware' => ['api', 'auth'],
], function ($router) {

    Route::group([
        'middleware' => ['api', 'auth', 'admin']
    ], function () {
        Route::apiResource('/topics', TopicController::class);
        Route::apiResource('/wordsets', WordsetController::class);
        Route::apiResource('/words', WordController::class);
    });

    Route::group([
        'middleware' => ['api', 'auth', 'user']
    ], function () {
        Route::get('/topics/{id}', [TopicController::class, 'show']);
        Route::get('/topics/', [TopicController::class, 'index']);
        Route::get('/wordsets/{id}', [WordsetController::class, 'show']);
        Route::get('/wordsets/', [WordsetController::class, 'index']);
        Route::get('/words/{id}', [WordController::class, 'show']);

        Route::get('/topics/{topic}/add', [TopicController::class, 'selectTopic']);
        Route::delete('/topics/{topic}/delete', [TopicController::class, 'deleteTopic']);
        Route::get('/selected', [TopicController::class, 'selectedList']);

        Route::get('/words/{word}/add', [WordController::class, 'markAsLearned']);
        Route::delete('/words/{word}/delete', [WordController::class, 'deleteFromLearned']);
        Route::get('/words/learned', [WordController::class, 'learned']);

        Route::get('learning', [TopicController::class, 'getLearningList']);
    });
});

