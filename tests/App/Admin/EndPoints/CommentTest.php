<?php

use Illuminate\Http\Response;
use Database\Factories\Comment\CommentFactory;
use Database\Factories\Client\UserFactory;
use Domain\Client\Enums\PermissionEnum;

beforeEach(function () {
    Artisan::call('passport:install');
    $this->comments = CommentFactory::new()->count(10)->create();
    $this->admin = UserFactory::new()->admin()->create();
    actingAs($this->admin, ['admin']);
});

it('gets paginated comments for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::COMMENT_VIEW->value, ['admin']);
    $this->get(route('admin.comment.index'))->assertStatus(Response::HTTP_OK);
});

it('gets a comment for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::COMMENT_VIEW->value, ['admin']);
    $this->get(route('admin.comment.show', ['comment' => $this->comments->first()->id]))
        ->assertStatus(Response::HTTP_OK);
});

it('approves a comment for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::COMMENT_APPROVE->value, ['admin']);
    $this->post(route('admin.comment.approve', ['comment' => $this->comments->first()->id]))
        ->assertStatus(Response::HTTP_OK);
});

it('deletes a comment for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::COMMENT_DELETE->value, ['admin']);
    $this->delete(route('admin.comment.destroy', ['comment' => $this->comments->first()]))
        ->assertStatus(Response::HTTP_OK);
});
