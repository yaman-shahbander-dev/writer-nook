<?php

use App\User\v1\Http\Client\Controllers\AuthController;

Route::controller(AuthController::class)
    ->name('user.')
    ->group(function () {
        Route::post('/register', 'register')
            ->name('register');

        Route::post('/login', 'login')
            ->name('login');

        Route::get('/logout', 'logout')
            ->middleware(['auth:api', 'scope:user'])
            ->name('logout');
    });
