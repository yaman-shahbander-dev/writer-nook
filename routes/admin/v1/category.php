<?php

use App\Admin\v1\Http\Category\Controllers\CategoryController;

Route::middleware('auth:api')->apiResource('category', CategoryController::class, [
    'names' => [
        'index' => 'admin.category.index',
        'store' => 'admin.category.store',
        'show' => 'admin.category.show',
        'update' => 'admin.category.update',
        'destroy' => 'admin.category.destroy',
    ]
]);
