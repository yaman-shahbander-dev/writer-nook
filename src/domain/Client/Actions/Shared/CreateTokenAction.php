<?php

namespace Domain\Client\Actions\Shared;

use Domain\Client\DataTransferObjects\AdminData;
use Domain\Client\DataTransferObjects\AuthorData;
use Domain\Client\DataTransferObjects\UserData;
use Domain\Client\Enums\UserScopes;
use Domain\Client\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateTokenAction
{
    use AsAction;

    public function __construct(
      protected User $user
    ) {
    }

    public function handle(User $user): UserData|AdminData|AuthorData
    {
        $user->bearerToken = $user->createToken(
           config('auth.defaults.token_name'),
           [$user->scope]
        )->accessToken;

        return match ($user->scope) {
            UserScopes::ADMIN->value => AdminData::from($user),
            UserScopes::AUTHOR->value => AuthorData::from($user),
            default => UserData::from($user),
        };
    }
}
