<?php

use Database\Factories\Client\UserFactory;
use Illuminate\Support\Facades\Artisan;
use Domain\Client\Actions\Author\LoginAction;
use Domain\Client\DataTransferObjects\AuthData;

it("it checks the login action for an author", function () {
    Artisan::call('passport:install');
    $author = UserFactory::new()->author()->create();
    $authorLoginData = [
        'email' => $author->email,
        'password' => 'password'
    ];
    $this->assertDatabaseCount('users', 1);
    $result = LoginAction::run(AuthData::from($authorLoginData));
    expect($result)->toBeObject();
});
