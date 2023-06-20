<?php

use App\Http\Controllers\Api\TopicController;
use App\Http\Controllers\Api\WordsetController;
use App\Http\Controllers\Api\WordController;
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
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('register', 'AuthController@register');
});

Route::middleware('auth:api')->apiResources([
    '/topics' => TopicController::class,
    '/wordsets' => WordsetController::class,
    '/words' => WordController::class
]);
