<?php

use App\User\v1\Http\Plan\Controllers\PlanController;

Route::controller(PlanController::class)
    ->name('user.')
    ->group(function () {
        Route::get('/plan', 'index')->name('plan.index');
        Route::get('/checkout/{plan}', 'checkout')->name('plan.checkout');
        Route::post('/subscribe/{plan}', 'subscribe')->name('plan.subscribe');
    });
