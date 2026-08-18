<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\RatingController;
use Illuminate\Support\Facades\Route;

// Public
Route::post('/login', [AuthController::class, 'login']);

// Protected - every endpoint below requires a valid Sanctum token
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/products', [RatingController::class, 'index']);
    Route::post('/products/{product}/rate', [RatingController::class, 'rate']);
    Route::match(['put', 'patch'], '/products/{product}/rate', [RatingController::class, 'update']);
    Route::delete('/products/{product}/rate', [RatingController::class, 'destroy']);

    // Bonus Task: Gpitg Hospital Patient Registration
    Route::post('/patient-registration', [PatientController::class, 'register']);
    Route::post('/patients/register', [PatientController::class, 'register']);
});
