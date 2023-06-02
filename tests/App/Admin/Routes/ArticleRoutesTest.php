<?php

test('checks if routes are exist in article file that is located in admin v1 folder', function () {
    $articleURL = config('app.url') . '/' . config('route-prefix.admin.v1.prefix') . '/' . config('route-prefix.admin.v1.article');

    $this->expect(route('admin.article.index'))
        ->toBe($articleURL . '/article');

    $this->expect(route('admin.article.show', ['article' => '0']))
        ->toBe($articleURL . '/article/0');

    $this->expect(route('admin.article.approve', ['article' => '0']))
        ->toBe($articleURL . '/article/0/approve');

    $this->expect(route('admin.article.destroy', ['article' => '0']))
        ->toBe($articleURL . '/article/0');

    $this->expect(route('admin.article.comment.create'))
        ->toBe($articleURL . '/article/comment');
});
