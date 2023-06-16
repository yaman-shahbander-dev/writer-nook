<?php

namespace Domain\Plan\Actions\Admin;

use Domain\Plan\DataTransferObjects\StripePlanData;
use Lorisleiva\Actions\Concerns\AsAction;
use Stripe\StripeClient;
use Stripe\Stripe;

class CreateStripePlanAction
{
    use AsAction;

    public function __construct(
        protected StripeClient $stripeClient
    ) {
        Stripe::setApiKey(config('payment.stripe.secret_key'));
    }

    public function handle(StripePlanData $data): string
    {
        $plan = $this->stripeClient->plans
            ->create([
                'amount_decimal' => $data->basePrice * 100,
                'currency' => $data->currency,
                'interval' => $data->duration,
                'product' => [
                    'name' => $data->name
                ],
                'nickname' => $data->description
            ]);

        return $plan->id;
    }
}
