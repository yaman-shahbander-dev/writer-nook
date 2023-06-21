<?php

use Illuminate\Http\Response;
use Database\Factories\Plan\PlanFactory;
use Database\Factories\Client\UserFactory;
use Database\Factories\Plan\FeatureFactory;
use Domain\Client\Enums\PermissionEnum;

beforeEach(function () {
    Artisan::call('passport:install');
    $this->plans = PlanFactory::new()->count(10)->create();
    $this->author = UserFactory::new()->author()->create();
    actingAs($this->author, ['author']);
});

it('gets paginated plans for the author', function () {
    actWithPermission($this->author, PermissionEnum::PLAN_VIEW->value, ['author']);
    $this->get(route('user.plan.index'))->assertStatus(Response::HTTP_OK);
});


