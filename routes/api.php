<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('register', [AuthenticationController::class, 'register']);
Route::post('login', [AuthenticationController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::apiResource('user', UserController::class)->except(['store','destroy']); 
    Route::post('logout', [AuthenticationController::class, 'logout']);
});
