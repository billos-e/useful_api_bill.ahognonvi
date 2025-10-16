<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// auth routes
Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register')->name('register');

    Route::middleware('api')->group(function () {

        Route::post('login', 'login');
        Route::post('logout', 'logout');

    });
});
