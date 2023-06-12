<?php

test('checks if routes are exist in article file that is located in user v1 folder', function () {
    $articleURL = config('app.url') . '/' . config('route-prefix.user.v1.prefix') . '/' . config('route-prefix.user.v1.article');

    $this->expect(route('user.article.index'))
        ->toBe($articleURL . '/article');

    $this->expect(route('user.article.show', ['article' => '0']))
        ->toBe($articleURL . '/article/0');

    $this->expect(route('user.article.store'))
        ->toBe($articleURL . '/article');

    $this->expect(route('user.article.update', ['article' => '0']))
        ->toBe($articleURL . '/article/0');

    $this->expect(route('user.article.destroy', ['article' => '0']))
        ->toBe($articleURL . '/article/0');

    $this->expect(route('user.article.articles'))
        ->toBe($articleURL . '/article/author-articles/get');

    $this->expect(route('user.article.ready', ['article' => '0']))
        ->toBe($articleURL . '/article/0/ready');

    $this->expect(route('user.article.like.unlike'))
        ->toBe($articleURL . '/article/like-or-unlike');
});
