<?php

use App\User\v1\Http\Article\Controllers\ArticleController;

Route::middleware('auth:api')
    ->name('user.')
    ->controller(ArticleController::class)
    ->group(function () {
        Route::get('/article','index')->name('article.index');
        Route::get('/article/{article}','show')->name('article.show');
        Route::middleware('scope:author')->group(function () {
            Route::post('/article','store')->name('article.store');
            Route::put('/article/{article}','update')->name('article.update');
            Route::delete('/article/{article}','destroy')->name('article.destroy');
            Route::get('/article/author-articles/get', 'getAuthorArticles')->name('article.articles');
            Route::put('/article/{article}/ready', 'ready')->name('article.ready');
        });
        Route::post('/article/comment', 'createComment')->name('article.comment.create');
        Route::post('/article/like-or-unlike', 'likeOrUnlike')->name('article.like.unlike');
    });
