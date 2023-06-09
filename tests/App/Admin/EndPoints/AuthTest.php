<?php

use Database\Factories\Client\UserFactory;
use Illuminate\Http\Response;
use Domain\Client\Enums\PermissionEnum;
use Database\Factories\Client\BecomeAuthorFactory;

beforeEach(function () {
   Artisan::call('passport:install');
   $this->admin = UserFactory::new()->admin()->create(['password' => 'password']);
   $this->loginData = [
       'email' => $this->admin->email,
       'password' => 'password',
   ];
   $this->becomeAuthor = BecomeAuthorFactory::new()->create();
});

it('tests admin login', function () {
   $this->post(route('admin.login', $this->loginData))
       ->assertStatus(Response::HTTP_OK);
});

it('tests getting paginated author requests for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::BECOME_AUTHOR_VIEW->value);
    $this->get(route('admin.become-author-requests.index'))
        ->assertStatus(Response::HTTP_OK);
});

it('tests approving an author request by the admin', function () {
    actWithPermission($this->admin, PermissionEnum::BECOME_AUTHOR_APPROVE->value);
    $this->post(route('admin.approve-author-requests.approve', ['becomeAuthor' => $this->becomeAuthor->id]))
        ->assertStatus(Response::HTTP_OK);
});

it('tests deleting an author request by the admin', function () {
    actWithPermission($this->admin, PermissionEnum::BECOME_AUTHOR_DELETE->value);
    $this->delete(route('admin.delete-author-requests.destroy', ['becomeAuthor' => $this->becomeAuthor->id]))
        ->assertStatus(Response::HTTP_OK);
});
