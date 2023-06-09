<?php

namespace Domain\Client\Services;

use Domain\Client\Actions\Admin\ApproveBecomeAuthorAction;
use Domain\Client\Actions\Admin\GetBecomeAuthorsAction;
use Domain\Client\Actions\Admin\DeleteBecomeAuthorAction;
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

    public function BecomeAuthorAction() {
        return GetBecomeAuthorsAction::run();
    }

    public function ApproveBecomeAuthorAction(string $id) {
        return ApproveBecomeAuthorAction::run($id);
    }

    public function DeleteBecomeAuthorAction(string $id) {
        return DeleteBecomeAuthorAction::run($id);
    }
}
