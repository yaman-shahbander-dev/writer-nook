<?php

namespace Domain\Client\Policies;

use Domain\Client\Enums\PermissionEnum;
use Domain\Client\Models\BecomeAuthor;
use Domain\Client\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BecomeAuthorPolicy
{
    use HandlesAuthorization;

    public function view(User $user, BecomeAuthor $becomeAuthor): bool
    {
        return $user->can(PermissionEnum::BECOME_AUTHOR_VIEW->value);
    }

    public function delete(User $user, BecomeAuthor $becomeAuthor): bool
    {
        return $user->can(PermissionEnum::BECOME_AUTHOR_DELETE->value);
    }

    public function approve(User $user, BecomeAuthor $becomeAuthor): bool
    {
        return $user->can(PermissionEnum::BECOME_AUTHOR_APPROVE->value);
    }

    public function send(User $user, BecomeAuthor $becomeAuthor): bool
    {
        return $user->can(PermissionEnum::BECOME_AUTHOR_SEND->value);
    }
}
