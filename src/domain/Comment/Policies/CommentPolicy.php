<?php

namespace Domain\Comment\Policies;

use Domain\Client\Enums\PermissionEnum;
use Illuminate\Auth\Access\HandlesAuthorization;
use Domain\Client\Models\User;
use Domain\Comment\Models\Comment;

class CommentPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Comment $comment): bool
    {
        return $user->can(PermissionEnum::COMMENT_VIEW->value);
    }

    public function create(User $user, Comment $comment): bool
    {
        return $user->can(PermissionEnum::COMMENT_CREATE->value);
    }

    public function update(User $user, Comment $comment): bool
    {
        return $user->can(PermissionEnum::COMMENT_APPROVE->value);
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $user->can(PermissionEnum::COMMENT_DELETE->value);
    }
}
