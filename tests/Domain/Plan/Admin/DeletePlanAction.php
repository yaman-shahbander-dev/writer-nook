<?php

use Database\Factories\Plan\PlanFactory;
use Domain\Plan\Actions\Admin\DeletePlanAction;

it('deletes a plan', function() {
    $plan = PlanFactory::new()->create();
    $result = DeletePlanAction::run($plan->id);
    expect($result)->toBeTrue();
});
