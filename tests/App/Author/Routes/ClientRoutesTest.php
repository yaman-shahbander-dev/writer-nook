<?php

test('checks if routes are exist in client file that is located in author v1 folder', function () {
    $clientURL = config('app.url') . '/' . config('route-prefix.author.v1.prefix') . '/' . config('route-prefix.author.v1.client');

    $this->expect(route('author.login'))
        ->toBe($clientURL . '/login');

    $this->expect(route('author.logout'))
        ->toBe($clientURL . '/logout');
});
