<?php

use App\Admin\v1\Http\Like\Controllers\LikeController;

Route::controller(LikeController::class)
    ->name('admin.')
    ->group(function () {
        Route::get('/like', 'index')->name('like.index');
        Route::get('/like/{like}', 'show')->name('like.show');
    });
