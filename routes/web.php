<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\ParticipantController;

Route::redirect('/', '/trainings');
Route::resource('trainings', TrainingController::class);
Route::post('trainings/{training}/participants', [TrainingController::class, 'register'])->name('trainings.register');
Route::delete('trainings/{training}/participants/{participant}', [TrainingController::class, 'unregister'])->name('trainings.unregister');
Route::resource('participants', ParticipantController::class);
