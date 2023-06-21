<?php

namespace Domain\Plan\Actions\User;

use Domain\Client\Models\User;
use Domain\Plan\DataTransferObjects\SubscriptionData;
use Domain\Plan\Models\Subscription;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\PaginatedDataCollection;

class GetUserSubscriptionsAction
{
    use AsAction;

    public function __construct(
        protected Subscription $subscription
    ) {
    }

    public function handle(User $user): PaginatedDataCollection
    {
        $subscriptions = $user->subscriptions()->paginate();
        return SubscriptionData::collection($subscriptions);
    }
}
