<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// auth routes
Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register')->name('register');

    Route::post('login', 'login');
    Route::post('logout', 'logout')->middleware('auth');;

});
