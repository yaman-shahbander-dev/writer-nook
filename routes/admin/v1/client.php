<?php

use App\Admin\v1\Http\Client\Controllers\AuthController;
use App\Admin\v1\Http\Client\Controllers\BecomeAuthorController;

Route::controller(AuthController::class)
    ->name('admin.')
    ->group(function () {

    Route::post('/login', 'login')
        ->name('login');

    Route::get('/logout', 'logout')
        ->middleware(['auth:api', 'scope:admin'])
        ->name('logout');
});

Route::controller(BecomeAuthorController::class)
    ->name('admin.')
    ->middleware('auth:api')
    ->group(function () {
        Route::get('/become-author-requests', 'index')->name('become-author-requests.index');
        Route::post('/approve-author-request/{becomeAuthor}', 'approve')->name('approve-author-requests.approve');
        Route::delete('/delete-author-request/{becomeAuthor}', 'destroy')->name('delete-author-requests.destroy');
    });
