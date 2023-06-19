<?php

namespace Domain\Plan\Services;

use Domain\Client\Models\User;
use Domain\Plan\Actions\Shared\GetPlansAction;
use Domain\Plan\Actions\User\CheckoutAction;
use Domain\Plan\Actions\User\SubscribeAction;
use Domain\Plan\Models\Plan;

class UserPlanService
{
    public function index()
    {
        return GetPlansAction::run();
    }

    public function checkout(string $planId, User $user)
    {
        return CheckoutAction::run($planId, $user);
    }

    public function subscribe(User $user, Plan $plan, string $paymentMethod)
    {
        return SubscribeAction::run($user, $plan, $paymentMethod);
    }
}
