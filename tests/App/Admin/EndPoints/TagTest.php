<?php

use Database\Factories\Tag\TagFactory;
use Illuminate\Http\Response;
use Database\Factories\Client\UserFactory;
use Domain\Client\Enums\PermissionEnum;

beforeEach(function () {
    Artisan::call('passport:install');
    $this->tags = TagFactory::new()->count(10)->create();
    $this->admin = UserFactory::new()->admin()->create();
    actingAs($this->admin, ['admin']);
});

it('gets paginated tags for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::TAG_VIEW_ANY->value, ['admin']);
    $this->get(route('admin.tag.index'))->assertStatus(Response::HTTP_OK);
});

it('gets a tag for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::TAG_VIEW_ANY->value, ['admin']);
    $this->get(route('admin.tag.show', ['tag' => $this->tags->first()->id]))
        ->assertStatus(Response::HTTP_OK);
});

it('stores a tag for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::TAG_CREATE->value, ['admin']);
    $this->post(route('admin.tag.store', ['name' => $this->tags->first()->name . ' test']))
        ->assertStatus(Response::HTTP_OK);
});

it('updates a tag for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::TAG_UPDATE->value, ['admin']);
    $this->put(
        route('admin.tag.update', [
        'tag' => $this->tags->first(),
        'name' => $this->tags->first()->name . ' test'
    ])
    )->assertStatus(Response::HTTP_OK);
});

it('deletes a tag for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::TAG_DELETE->value, ['admin']);
    $this->delete(route('admin.tag.destroy', ['tag' => $this->tags->first()]))
        ->assertStatus(Response::HTTP_OK);
});
