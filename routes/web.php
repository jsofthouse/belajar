<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainingController;

Route::redirect('/', '/trainings');
Route::resource('trainings', TrainingController::class);
