<?php

namespace Domain\Client\Actions\Author;

use App\Exceptions\Client\UserNotFoundException;
use Domain\Client\Actions\Shared\CreateTokenAction;
use Domain\Client\DataTransferObjects\AuthorData;
use Domain\Client\DataTransferObjects\AuthData;
use Domain\Client\Enums\UserTypes;
use Domain\Client\Models\User;
use Illuminate\Support\Facades\Hash;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class LoginAction
{
    use AsAction;

    public function __construct(protected User $user)
    {
    }

    public function handle(AuthData $user): AuthorData|null
    {
        $author = QueryBuilder::for($this->user)
            ->where([
                'email' => $user->email,
                'type' => UserTypes::AUTHOR
            ])
            ->first();

        if (!$author) {
            throw new UserNotFoundException();
        }

        if (Hash::check($user->password, $author->password)) {
            return CreateTokenAction::run($author);
        }

        return null;
    }
}
