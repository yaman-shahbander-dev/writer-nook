<?php

use Illuminate\Http\Response;
use Database\Factories\Client\UserFactory;
use Database\Factories\Plan\FeatureFactory;
use Domain\Client\Enums\PermissionEnum;

beforeEach(function () {
    Artisan::call('passport:install');
    $this->features = FeatureFactory::new()->count(10)->create();
    $this->admin = UserFactory::new()->admin()->create();
    $this->feature = FeatureFactory::new()->definition();
    $this->updateFeature = [
        'name' => $this->features->first()->id,
        'key' => $this->features->first()->key,
        'description' => $this->features->first()->description,
        'feature' => $this->features->first()->id,
    ];
    actingAs($this->admin, ['admin']);
});

it('gets paginated features for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::FEATURE_VIEW->value, ['admin']);
    $this->get(route('admin.feature.index'))->assertStatus(Response::HTTP_OK);
});

it('gets a feature for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::FEATURE_VIEW->value, ['admin']);
    $this->get(route('admin.feature.show', ['feature' => $this->features->first()->id]))
        ->assertStatus(Response::HTTP_OK);
});

it('stores a feature for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::FEATURE_CREATE->value, ['admin']);
    $this->post(route('admin.feature.store', $this->feature))
        ->assertStatus(Response::HTTP_OK);
});

it('updates a feature for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::FEATURE_UPDATE->value, ['admin']);
    $this->put(route('admin.feature.update',  $this->updateFeature))
        ->assertStatus(Response::HTTP_OK);
});

it('deletes a plan for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::FEATURE_DELETE->value, ['admin']);
    $this->delete(route('admin.feature.destroy', ['feature' => $this->features->first()->id]))
        ->assertStatus(Response::HTTP_OK);
});
