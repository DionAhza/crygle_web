<?php

use App\Http\Controllers\auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.index');
});

Route::get('/login',[AuthController::class, 'index']);
Route::get('/register',[AuthController::class, 'register']);