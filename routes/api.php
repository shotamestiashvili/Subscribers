<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['api', 'auth:sanctum'])->group(function () {
    Route::post('subscribers', \App\Http\Controllers\Api\CreateSubscriberController::class);
});


Route::post('user', [\App\Http\Controllers\UserController::class, 'create']);
Route::get('user', [\App\Http\Controllers\UserController::class, 'index']);
