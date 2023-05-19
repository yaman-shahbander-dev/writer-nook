<?php

namespace Domain\Client\Services;

use Domain\Client\Actions\Admin\LoginAction;
use Domain\Client\Actions\Shared\RevokeTokenAction;
use Domain\Client\DataTransferObjects\AuthData;
use Domain\Client\Models\User;

class AdminAuthService
{
    public function login(AuthData $admin) {
        return LoginAction::run($admin);
    }

    public function logout(User $admin) {
        return RevokeTokenAction::run($admin);
    }
}
