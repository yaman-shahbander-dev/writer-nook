<?php

namespace Domain\Plan\Policies;

use Domain\Client\Enums\PermissionEnum;
use Domain\Client\Models\User;
use Domain\Plan\Models\Plan;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlanPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Plan $plan): bool
    {
        return $user->can(PermissionEnum::PLAN_VIEW->value);
    }

    public function store(User $user, Plan $plan): bool
    {
        return $user->can(PermissionEnum::PLAN_CREATE->value);
    }

    public function update(User $user, Plan $plan): bool
    {
        return $user->can(PermissionEnum::PLAN_UPDATE->value);
    }

    public function delete(User $user, Plan $plan): bool
    {
        return $user->can(PermissionEnum::PLAN_DELETE->value);
    }

    public function cancel(User $user, Plan $plan): bool
    {
        return $user->can(PermissionEnum::PLAN_CANCEL->value);
    }

    public function resume(User $user, Plan $plan): bool
    {
        return $user->can(PermissionEnum::PLAN_RESUME->value);
    }

    public function checkout(User $user, Plan $plan): bool
    {
        return $user->can(PermissionEnum::PLAN_CHECKOUT->value);
    }

    public function subscribe(User $user, Plan $plan): bool
    {
        return $user->can(PermissionEnum::PLAN_SUBSCRIBE->value);
    }
}
