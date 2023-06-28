<?php

use Database\Factories\Plan\FeatureFactory;
use Domain\Plan\Actions\Admin\DeleteFeatureAction;

it('deletes a feature', function () {
    $this->assertDatabaseCount('features', 0);
    $feature = FeatureFactory::new()->create();
    $this->assertDatabaseCount('features', 1);
    $result = DeleteFeatureAction::run($feature->id);
    expect($result)->toBeTrue();
});
