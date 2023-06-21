<?php

use Database\Factories\Plan\PlanFactory;
use Domain\Plan\Actions\Admin\ShowPlanAction;

it('shows a plan', function () {
    $plan = PlanFactory::new()->create();
    $plan = ShowPlanAction::run($plan->id);
    expect($plan)
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
