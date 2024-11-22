<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;

use App\Http\Controllers\LighthouseController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/lighthouse/check', [LighthouseController::class, 'checkPerformance']);

Route::get('login/google', [GoogleController::class, 'redirectToGoogle']);
Route::post('/lighthouse/check', [LighthouseController::class, 'checkPerformance']);
Route::get('login/google/callback', [GoogleController::class, 'handleGoogleCallback']);


