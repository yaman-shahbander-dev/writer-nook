<?php

use Database\Factories\Plan\FeatureFactory;
use Domain\Plan\Actions\Admin\GetFeaturesAction;

it('checks getting paginated features', function () {
    FeatureFactory::new()->count(10)->create();
    $features = GetFeaturesAction::run();
    expect($features)->toHaveCount(10);
});
