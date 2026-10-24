<?php

use App\Http\Controllers\DevicePreviewController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/students');

Route::resource('students', StudentController::class);

Route::get('/switch-device/{mode}', DevicePreviewController::class)->name('device.switch');
