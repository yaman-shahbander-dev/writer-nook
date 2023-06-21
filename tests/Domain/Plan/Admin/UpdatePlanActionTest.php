<?php

use Domain\Plan\Actions\Admin\CreatePlanAction;
use Domain\Plan\DataTransferObjects\CreatePlanData;
use Database\Factories\Plan\FeatureFactory;
use Domain\Plan\Actions\Admin\UpdatePlanAction;
use Domain\Plan\DataTransferObjects\UpdatePlanData;
use Domain\Plan\Actions\Admin\CreateFeatureAction;
use Domain\Plan\DataTransferObjects\FeatureData;
use Database\Factories\Plan\PlanFactory;

it('creates a plan', function () {
    $this->assertDatabaseCount('features', 0);
    $feature = FeatureFactory::new()->definition();
    $feature = CreateFeatureAction::run(FeatureData::from($feature));
    $this->assertDatabaseCount('features', 1);
    $plan = PlanFactory::new()->create();
//    $plan['features'][0] = [
//        'id' => $feature->id,
//        'quantity' => 10
//    ];
    $plan->features = [
        [
            'id' => $feature->id,
            'quantity' => 10
        ]
    ];
    $result = UpdatePlanAction::run(UpdatePlanData::from($plan));
    expect($result)->toBeTrue();
});
