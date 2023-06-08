<?php

test('checks if routes are exist in like file that is located in admin v1 folder', function () {
    $likeURL = config('app.url') . '/' . config('route-prefix.admin.v1.prefix') . '/' . config('route-prefix.admin.v1.like');

    $this->expect(route('admin.like.index'))
        ->toBe($likeURL . '/like');

    $this->expect(route('admin.like.show', ['like' => '0']))
        ->toBe($likeURL . '/like/0');
});
