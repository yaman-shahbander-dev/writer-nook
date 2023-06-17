<?php

use App\Admin\v1\Http\Plan\Controllers\PlanController;
use App\Admin\v1\Http\Plan\Controllers\FeatureController;

Route::apiResource('plan', PlanController::class, [
    'names' => [
        'index' => 'admin.plan.index',
        'store' => 'admin.plan.store',
        'show' => 'admin.plan.show',
        'update' => 'admin.plan.update',
        'destroy' => 'admin.plan.destroy',
    ]
]);

Route::apiResource('feature', FeatureController::class, [
    'names' => [
        'index' => 'admin.feature.index',
        'store' => 'admin.feature.store',
        'show' => 'admin.feature.show',
        'update' => 'admin.feature.update',
        'destroy' => 'admin.feature.destroy',
    ]
]);
