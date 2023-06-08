<?php

use Illuminate\Http\Response;
use Database\Factories\Like\LikeFactory;
use Database\Factories\Client\UserFactory;
use Domain\Client\Enums\PermissionEnum;

beforeEach(function () {
    Artisan::call('passport:install');
    $this->likes = LikeFactory::new()->count(10)->create();
    $this->admin = UserFactory::new()->admin()->create();
    actingAs($this->admin, ['admin']);
});

it('gets paginated likes for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::LIKE_VIEW->value, ['admin']);
    $this->get(route('admin.like.index'))->assertStatus(Response::HTTP_OK);
});

it('gets a like for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::LIKE_VIEW->value, ['admin']);
    $this->get(route('admin.like.show', ['like' => $this->likes->first()->id]))
        ->assertStatus(Response::HTTP_OK);
});
