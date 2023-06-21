<?php

use App\Admin\v1\Http\Plan\Controllers\PlanController;
use App\Admin\v1\Http\Plan\Controllers\FeatureController;

Route::name('admin.')
    ->controller(PlanController::class)
    ->group(function () {
       Route::get('/get-subscriptions', 'getSubscriptions')
           ->name('plan.subscriptions');
       Route::get('/cancel-user-subscription/{user}', 'cancelUserSubscription')
           ->name('plan.cancel.user.subscription');
        Route::get('/resume-user-subscription/{user}', 'resumeUserSubscription')
            ->name('plan.resume.user.subscription');
    });

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
