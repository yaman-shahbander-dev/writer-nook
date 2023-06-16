<?php

use App\Admin\v1\Http\Plan\Controllers\PlanController;

Route::apiResource('plan', PlanController::class, [
    'names' => [
        'index' => 'admin.plan.index',
        'store' => 'admin.plan.store',
        'show' => 'admin.plan.show',
        'update' => 'admin.plan.update',
        'destroy' => 'admin.plan.destroy',
    ]
]);
