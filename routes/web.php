<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', function () {
    return view('user.index');
});

// Auth
Route::get('/login', [AuthController::class, 'index']);
Route::get('/register', [AuthController::class, 'register']);

// Course
Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{id}', [CourseController::class, 'show']);
