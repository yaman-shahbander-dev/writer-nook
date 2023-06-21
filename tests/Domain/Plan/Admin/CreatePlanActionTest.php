<?php

use Domain\Plan\Actions\Admin\CreatePlanAction;
use Domain\Plan\DataTransferObjects\CreatePlanData;
use Database\Factories\Plan\FeatureFactory;
use Domain\Plan\Actions\Admin\CreateFeatureAction;
use Domain\Plan\DataTransferObjects\FeatureData;
use Database\Factories\Plan\PlanFactory;

it('creates a plan', function () {
    $this->assertDatabaseCount('features', 0);
    $feature = FeatureFactory::new()->definition();
    $feature = CreateFeatureAction::run(FeatureData::from($feature));
    $this->assertDatabaseCount('features', 1);
    $plan = PlanFactory::new()->definition();
    $plan['features'][0] = [
        'id' => $feature->id,
        'quantity' => 10
    ];
    $plan = CreatePlanAction::run(CreatePlanData::from($plan));
    expect($plan->toArray())
        ->toHaveKeys([
            'id',
            'stripe_price_plan',
            'stripe_product_id',
            'type',
            'duration',
            'hidden_at',
            'name',
            'description',
            'base_price',
            'discount',
            'created_at',
            'updated_at',
            'deleted_at',
            'features',
            'user_plans',
        ]);
});
