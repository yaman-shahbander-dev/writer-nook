<?php

test('checks if routes are exist in client file that is located in admin v1 folder', function () {
    $clientURL = config('app.url') . '/' . config('route-prefix.admin.v1.prefix') . '/' . config('route-prefix.admin.v1.client');

    $this->expect(route('admin.login'))
        ->toBe($clientURL . '/login');

    $this->expect(route('admin.logout'))
        ->toBe($clientURL . '/logout');

    $this->expect(route('admin.become-author-requests.index'))
        ->toBe($clientURL . '/become-author-requests');

    $this->expect(route('admin.approve-author-requests.approve', ['becomeAuthor' => '0']))
        ->toBe($clientURL . '/approve-author-request/0');

    $this->expect(route('admin.delete-author-requests.destroy', ['becomeAuthor' => '0']))
        ->toBe($clientURL . '/delete-author-request/0');
});
