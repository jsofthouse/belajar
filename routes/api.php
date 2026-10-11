<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TrainingController;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/trainings', TrainingController::class);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/trainings', [TrainingController::class, 'index']);
Route::get('/trainings/{training}', [TrainingController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/trainings', [TrainingController::class, 'store']);
    Route::put('/trainings/{training}', [TrainingController::class, 'update']);
    Route::delete('/trainings/{training}', [TrainingController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
