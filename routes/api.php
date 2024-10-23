<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Company\GigController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::post('register', [AuthenticationController::class, 'register']);
Route::post('login', [AuthenticationController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::apiResource('user', UserController::class)->except(['store','destroy']); 
    Route::apiResource('company', CompanyController::class);
    Route::apiResource('company/{company}/gig', GigController::class);
    Route::get('/gigs/search/{term}', [GigController::class, 'search']);
    Route::get('/gigs/filter', [GigController::class, 'filter']);
    Route::post('logout', [AuthenticationController::class, 'logout']);
});
