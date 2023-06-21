<?php

use Database\Factories\Plan\FeatureFactory;
use Domain\Plan\Actions\Admin\CreateFeatureAction;
use Domain\Plan\DataTransferObjects\FeatureData;

it('creates a feature', function () {
    $this->assertDatabaseCount('features', 0);
    $feature = FeatureFactory::new()->definition();
    $result = CreateFeatureAction::run(FeatureData::from($feature));
    $this->assertDatabaseCount('features', 1);

    expect($result->toArray())
        ->toHaveKeys([
            'id',
            'name',
            'key',
            'description',
            'created_at',
            'updated_at',
            'deleted_at'
        ]);
});
