<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RatingController;
use Illuminate\Support\Facades\Route;

// Public
Route::post('/login', [AuthController::class, 'login']);

// Protected - every endpoint below requires a valid Sanctum token
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/products', [RatingController::class, 'index']);
    Route::post('/products/{product}/rate', [RatingController::class, 'rate']);
    Route::put('/products/{product}/rate', [RatingController::class, 'update']);
    Route::delete('/products/{product}/rate', [RatingController::class, 'destroy']);
});
