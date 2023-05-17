<?php

use Database\Factories\Client\UserFactory;
use Illuminate\Http\Response;

beforeEach(function () {
   Artisan::call('passport:install');
   $this->author = UserFactory::new()->author()->create(['password' => 'password']);
   $this->loginData = [
       'email' => $this->author->email,
       'password' => 'password',
   ];
});

it('tests author login', function () {
   $this->post(route('author.login', $this->loginData))
       ->assertStatus(Response::HTTP_OK);
});
