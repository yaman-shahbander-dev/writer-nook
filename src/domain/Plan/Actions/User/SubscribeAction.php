<?php

namespace Domain\Plan\Actions\User;

use Domain\Client\Models\User;
use Domain\Plan\Models\Plan;
use Lorisleiva\Actions\Concerns\AsAction;

class SubscribeAction
{
    use AsAction;

    public function __construct() {
    }

    public function handle(User $user, Plan $plan, string $paymentMethod): bool
    {
        $result1 = $user->createOrGetStripeCustomer();
        $result2 = $user->addPaymentMethod($paymentMethod);
        $result3 = $user->newSubscription(
            $plan->name,
            $plan->stripe_price_plan
        )->create($paymentMethod);

        return $result1 && $result2 && $result3;
    }
}
