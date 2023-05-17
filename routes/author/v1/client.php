<?php

use App\Author\v1\Http\Client\Controllers\AuthController;

Route::controller(AuthController::class)
    ->name('author.')
    ->group(function () {
        Route::post('/login', 'login')
            ->name('login');

        Route::get('/logout', 'logout')
            ->middleware(['auth:api', 'scope:author'])
            ->name('logout');
    });
