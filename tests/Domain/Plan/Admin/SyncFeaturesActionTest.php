<?php

use Database\Factories\Plan\PlanFactory;
use Database\Factories\Plan\FeatureFactory;
use Domain\Plan\Actions\Admin\SyncFeaturesAction;

it('syncs features', function () {
   $plan = PlanFactory::new()->create();
   $feature = FeatureFactory::new()->create();
   $features[0] = [
       'id' => $feature->id,
       'quantity' => 10
   ];
    $features = SyncFeaturesAction::run($plan, $features);
    expect($features)->toBeObject();
});
