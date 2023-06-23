<?php

use App\Admin\v1\Http\Like\Controllers\LikeController;

Route::middleware('auth:api')
    ->name('admin.')
    ->controller(LikeController::class)
    ->group(function () {
        Route::get('/like', 'index')->name('like.index');
        Route::get('/like/{like}', 'show')->name('like.show');
    });
