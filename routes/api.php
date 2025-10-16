<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ShortLinkController;
use App\Http\Middleware\CheckModuleActive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// auth routes
Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register')->name('register');

    Route::post('login', 'login');
    Route::post('logout', 'logout')->middleware('auth');;

});

// need to authenticate
Route::middleware('auth')
    ->group(function () {

        // module routes
        Route::prefix('modules')->name('modules')
            ->controller(ModuleController::class)
            ->group(function () {

                Route::get('/', 'index')->name('all');
                Route::get('/{id}/activate', 'activate')->name('activate');
                Route::get('/{id}/deactivate', 'deactivate')->name('deactivate');
            });

        // module 1 routes
        Route::controller(ShortLinkController::class)
            ->middleware(CheckModuleActive::class.':1')
            ->group(function () {

                Route::get('/links', 'index')->name('all_links');
                Route::delete('/links/{id}', 'delete')->name('delete');
                Route::post('/shorten', 'store')->name('short_link');
            });

    }
);
