<?php

use Database\Factories\Plan\PlanFactory;
use Domain\Plan\Actions\Shared\GetPlansAction;
use Illuminate\Pagination\LengthAwarePaginator;

it('gets plans', function () {
    PlanFactory::new()->count(10)->create();
    $plans = GetPlansAction::run();
    expect($plans->items())->toBeInstanceOf(LengthAwarePaginator::class);
});
