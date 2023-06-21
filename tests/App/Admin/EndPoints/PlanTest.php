<?php

use Illuminate\Http\Response;
use Database\Factories\Plan\PlanFactory;
use Database\Factories\Client\UserFactory;
use Database\Factories\Plan\FeatureFactory;
use Domain\Client\Enums\PermissionEnum;

beforeEach(function () {
    Artisan::call('passport:install');
    $this->plans = PlanFactory::new()->count(10)->create();
    $this->admin = UserFactory::new()->admin()->create();
    actingAs($this->admin, ['admin']);
});

it('gets paginated plans for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::PLAN_VIEW->value, ['admin']);
    $this->get(route('admin.plan.index'))->assertStatus(Response::HTTP_OK);
});

it('gets a plan for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::PLAN_VIEW->value, ['admin']);
    $this->get(route('admin.plan.show', ['plan' => $this->plans->first()->id]))
        ->assertStatus(Response::HTTP_OK);
});

it('deletes a plan for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::PLAN_DELETE->value, ['admin']);
    $this->delete(route('admin.plan.destroy', ['plan' => $this->plans->first()->id]))
        ->assertStatus(Response::HTTP_OK);
});
