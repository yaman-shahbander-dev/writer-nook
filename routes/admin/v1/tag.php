<?php

use App\Admin\v1\Http\Tag\Controllers\TagController;

Route::apiResource('tag', TagController::class, [
    'names' => [
        'index' => 'admin.tag.index',
        'store' => 'admin.tag.store',
        'show' => 'admin.tag.show',
        'update' => 'admin.tag.update',
        'destroy' => 'admin.tag.destroy',
    ]
]);
