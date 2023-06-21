<?php

namespace Domain\Plan\Actions\Admin;

use Domain\Plan\DataTransferObjects\SubscriptionData;
use Domain\Plan\Models\Subscription;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\QueryBuilder;

class GetSubscriptionsAction
{
    use AsAction;

    public function __construct(
        protected Subscription $subscription
    ) {
    }

    public function handle(): PaginatedDataCollection
    {
        $subscriptions = QueryBuilder::for($this->subscription)
            ->allowedIncludes(['user'])
            ->paginate();

        return SubscriptionData::collection($subscriptions);
    }
}
