<?php

namespace Domain\Tag\Policies;

use Domain\Tag\Models\Tag;
use Domain\Client\Enums\PermissionEnum;
use Illuminate\Auth\Access\HandlesAuthorization;
use Domain\Client\Models\User;

class TagPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Tag $tag): bool
    {
        return $user->can(PermissionEnum::TAG_VIEW_ANY->value);
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionEnum::TAG_CREATE->value);
    }

    public function update(User $user, Tag $tag): bool
    {
        return $user->can(PermissionEnum::TAG_UPDATE->value);
    }

    public function delete(User $user, Tag $tag): bool
    {
        return $user->can(PermissionEnum::TAG_DELETE->value);
    }
}
