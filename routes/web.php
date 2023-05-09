<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Mail\Broadcast\SendBroadcastController;
use \App\Http\Controllers\SubscriberController;
use \App\Http\Controllers\ImportSubscribersController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('subscribers', SubscriberController::class);
    Route::post(
        'subscribers/import',
        ImportSubscribersController::class);
    Route::patch(
        'broadcasts/{broadcast}/send',
        SendBroadcastController::class
    );
    Route::get(
'broadcasts/{broadcast}/preview',
\App\Http\Controllers\Mail\Broadcast\PreviewBroadcastController::class
);
});

