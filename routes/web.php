<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\ParticipantController;

Route::redirect('/', '/trainings');
Route::resource('trainings', TrainingController::class);
Route::resource('participants', ParticipantController::class);
