<?php

test('checks if routes are exist in plan file that is located in admin v1 folder', function () {
    $planURL = config('app.url') . '/' . config('route-prefix.admin.v1.prefix') . '/' . config('route-prefix.admin.v1.plan');

    $this->expect(route('admin.plan.subscriptions'))
        ->toBe($planURL . '/get-subscriptions');

    $this->expect(route('admin.plan.cancel.user.subscription', ['user' => 0]))
        ->toBe($planURL . '/cancel-user-subscription/0');

    $this->expect(route('admin.plan.resume.user.subscription', ['user' => 0]))
        ->toBe($planURL . '/resume-user-subscription/0');

    $this->expect(route('admin.plan.index'))
        ->toBe($planURL . '/plan');

    $this->expect(route('admin.plan.show', ['plan' => 0]))
        ->toBe($planURL . '/plan/0');

    $this->expect(route('admin.plan.store'))
        ->toBe($planURL . '/plan');

    $this->expect(route('admin.plan.update', ['plan' => 0]))
        ->toBe($planURL . '/plan/0');

    $this->expect(route('admin.plan.destroy', ['plan' => 0]))
        ->toBe($planURL . '/plan/0');
});
