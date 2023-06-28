<?php

namespace Domain\Plan\Policies;

use Domain\Client\Enums\PermissionEnum;
use Domain\Client\Models\User;
use Domain\Plan\Models\Feature;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeaturePolicy
{
    use HandlesAuthorization;

    public function view(User $user, Feature $feature): bool
    {
        return $user->can(PermissionEnum::FEATURE_VIEW->value);
    }

    public function store(User $user, Feature $feature): bool
    {
        return $user->can(PermissionEnum::FEATURE_CREATE->value);
    }

    public function update(User $user, Feature $feature): bool
    {
        return $user->can(PermissionEnum::FEATURE_UPDATE->value);
    }

    public function delete(User $user, Feature $feature): bool
    {
        return $user->can(PermissionEnum::FEATURE_DELETE->value);
    }
}
