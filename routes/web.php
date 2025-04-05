<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;

//Auth Routes
Route::get('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
