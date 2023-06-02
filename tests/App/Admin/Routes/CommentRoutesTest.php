<?php

test('checks if routes are exist in comment file that is located in admin v1 folder', function () {
    $commentURL = config('app.url') . '/' . config('route-prefix.admin.v1.prefix') . '/' . config('route-prefix.admin.v1.comment');

    $this->expect(route('admin.comment.index'))
        ->toBe($commentURL . '/comment');

    $this->expect(route('admin.comment.show', ['comment' => '0']))
        ->toBe($commentURL . '/comment/0');

    $this->expect(route('admin.comment.store'))
        ->toBe($commentURL . '/comment');

    $this->expect(route('admin.comment.approve', ['comment' => '0']))
        ->toBe($commentURL . '/comment/0/approve');

    $this->expect(route('admin.comment.destroy', ['comment' => '0']))
        ->toBe($commentURL . '/comment/0');
});
