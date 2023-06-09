<?php

namespace Domain\Client\Actions\Admin;

use App\Exceptions\Client\DataNotFoundException;
use Domain\Client\Enums\UserScopes;
use Domain\Client\Enums\UserTypes;
use Domain\Client\Models\BecomeAuthor;
use Domain\Client\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class ApproveBecomeAuthorAction
{
    use AsAction;

    public function __construct(
        protected BecomeAuthor $becomeAuthor,
        protected User $user
    ) {
    }

    public function handle(string $id): DataNotFoundException|bool
    {
        $becomeAuthors = QueryBuilder::for($this->becomeAuthor)
            ->where('id', $id)
            ->whereNull('deleted_at')
            ->first();

        if (!$becomeAuthors) {
            return throw new DataNotFoundException();
        }

        $result = $becomeAuthors->update([
            'approved' => true
        ]);

        if ($result) {
            return QueryBuilder::for($this->user)
                ->where('id', $becomeAuthors->user_id)
                ->update([
                    'scope' => UserScopes::AUTHOR->value,
                    'type' => UserTypes::AUTHOR->value
                ]);
        }

        return false;
    }
}
