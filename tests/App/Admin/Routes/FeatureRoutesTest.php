<?php

test('checks if routes are exist in plan file that is located in admin v1 folder for the features', function () {
    $featureURL = config('app.url') . '/' . config('route-prefix.admin.v1.prefix') . '/' . config('route-prefix.admin.v1.plan');

    $this->expect(route('admin.feature.index'))
        ->toBe($featureURL . '/feature');

    $this->expect(route('admin.feature.show', ['feature' => 0]))
        ->toBe($featureURL . '/feature/0');

    $this->expect(route('admin.feature.store'))
        ->toBe($featureURL . '/feature');

    $this->expect(route('admin.feature.update', ['feature' => 0]))
        ->toBe($featureURL . '/feature/0');

    $this->expect(route('admin.feature.destroy', ['feature' => 0]))
        ->toBe($featureURL . '/feature/0');
});
