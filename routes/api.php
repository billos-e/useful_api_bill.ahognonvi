<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ModuleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// auth routes
Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register')->name('register');

    Route::post('login', 'login');
    Route::post('logout', 'logout')->middleware('auth');;

});

// module routes
Route::prefix('modules')->name('modules')
    ->middleware('auth')
    ->controller(ModuleController::class)
    ->group(function () {

        Route::get('/', 'index')->name('all');
        Route::get('/{id}/activate', 'activate')->name('activate');
        Route::get('/{id}/deactivate', 'deactivate')->name('deactivate');
    }
);
