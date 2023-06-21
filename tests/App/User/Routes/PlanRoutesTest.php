<?php

test('checks if routes are exist in plan file that is located in admin v1 folder', function () {
    $planURL = config('app.url') . '/' . config('route-prefix.user.v1.prefix') . '/' . config('route-prefix.user.v1.plan');

    $this->expect(route('user.plan.index'))
        ->toBe($planURL . '/plan');

    $this->expect(route('user.plan.checkout', ['plan' => 0]))
        ->toBe($planURL . '/checkout/0');

    $this->expect(route('user.plan.subscribe', ['plan' => 0]))
        ->toBe($planURL . '/subscribe/0');

    $this->expect(route('user.plan.subscriptions'))
        ->toBe($planURL . '/get-user-subscriptions');

    $this->expect(route('user.plan.cancel.subscription'))
        ->toBe($planURL . '/cancel-subscription');

    $this->expect(route('user.plan.resume.subscription'))
        ->toBe($planURL . '/resume-subscription');
});
