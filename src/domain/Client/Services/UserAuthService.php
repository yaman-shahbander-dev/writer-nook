<?php

namespace Domain\Client\Services;

use Domain\Client\Actions\Shared\RevokeTokenAction;
use Domain\Client\Actions\User\LoginAction;
use Domain\Client\Actions\User\RegisterUserAction;
use Domain\Client\DataTransferObjects\AuthData;
use Domain\Client\Models\User;

class UserAuthService
{
    public function register(AuthData $authData) {
        return RegisterUserAction::run($authData);
    }

    public function login(AuthData $data, ?User $authUser = null) {
       return LoginAction::run($data, $authUser);
    }

    public function logout(User $user) {
        return RevokeTokenAction::run($user);
    }
}
