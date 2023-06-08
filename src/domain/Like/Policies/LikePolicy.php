<?php

namespace Domain\Like\Policies;

use Domain\Client\Enums\PermissionEnum;
use Domain\Client\Models\User;
use Domain\Like\Models\Like;
use Illuminate\Auth\Access\HandlesAuthorization;

class LikePolicy
{
    use HandlesAuthorization;

    public function view(User $user, Like $like): bool
    {
        return $user->can(PermissionEnum::LIKE_VIEW->value);
    }

    public function create(User $user, Like $like): bool
    {
        return $user->can(PermissionEnum::LIKE_CREATE->value);
    }
}
