<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;

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

Route::group(['namespace' => 'App\Http\Controllers\Api'], function () {
    Route::post('/login', 'AuthController@login')->name('login');
    Route::post('/register', 'AuthController@register')->name('register');

    Route::middleware('auth:sanctum')->group(function() {
        Route::apiResource('tasks', TaskController::class);
        Route::patch('/tasks/{task}', TaskController::class . '@update');
        Route::delete('/tasks/{task}', TaskController::class . '@destroy');
        Route::patch('/tasks/{task}/change-to-done', TaskController::class . '@changeTaskStatusToDone');
    });
});
