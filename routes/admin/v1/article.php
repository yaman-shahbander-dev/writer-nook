<?php

use App\Admin\v1\Http\Article\Controllers\ArticleController;

Route::name('admin.')
    ->controller(ArticleController::class)
    ->group(function () {
    Route::get('/article', 'index')->name('article.index');
    Route::get('/article/{article}', 'show')->name('article.show');
    Route::put('/article/{article}/approve', 'approve')->name('article.approve');
    Route::delete('/article/{article}', 'destroy')->name('article.destroy');
    Route::post('/article/comment', 'createComment')->name('article.comment.create');
});
