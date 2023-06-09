<?php

use Database\Factories\Client\UserFactory;
use Illuminate\Http\Response;
use Domain\Client\Enums\UserGenders;
use Domain\Client\Enums\PermissionEnum;

beforeEach(function () {
   Artisan::call('passport:install');
   $this->user = UserFactory::new()->create(['password' => 'password']);
   $this->loginData = [
       'email' => $this->user->email,
       'password' => 'password',
   ];
    $this->registerData = [
        'email' => config('testing.default_email'),
        'password' => 'password',
        'first_name' => 'alex',
        'last_name' => 'miller',
        'name' => 'alex miller',
        'gender' => UserGenders::getRandomValue(),
        'password_confirmation' => 'password'
    ];
    $this->becomeAuthorData = [
        'title' => 'some title',
        'description' => 'some description'
    ];
});

it('tests user login', function () {
   $this->post(route('user.login', $this->loginData))
       ->assertStatus(Response::HTTP_OK);
});

it('tests user register', function () {
    $this->post(route('user.register', $this->registerData))
        ->assertStatus(Response::HTTP_OK);
});

it('tests sending a become author request by the user', function () {
    actWithPermission($this->user, PermissionEnum::BECOME_AUTHOR_SEND->value);
    $this->post(route('user.become-author.send', $this->becomeAuthorData))
        ->assertStatus(Response::HTTP_OK);
});
