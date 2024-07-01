<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UploadEmployeeController;
use Illuminate\Support\Facades\Route;

Route::resource('', EmployeeController::class);
Route::resource('upload', UploadEmployeeController::class);
