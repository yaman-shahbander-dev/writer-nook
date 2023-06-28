<?php

use Database\Factories\Plan\FeatureFactory;
use Domain\Plan\Actions\Admin\ShowFeatureAction;

it('checks showing a feature', function () {
    $feature = FeatureFactory::new()->create();
    $feature = ShowFeatureAction::run($feature->id);
    expect($feature)
        ->toBeObject()
        ->toHaveKeys([
            'id',
            'name',
            'key',
            'description',
            'created_at',
            'updated_at',
            'deleted_at',
        ]);
});
