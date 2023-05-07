<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Channel\ChannelController;
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

Route::prefix('v1/')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        Route::resource('channel', ChannelController::class)
            ->only([
                'index',
                'store',
                'update',
                'destroy',
            ]);
    });
    Route::post('auth/token', [AuthController::class, 'getToken']);
});

