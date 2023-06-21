<?php

namespace Domain\Plan\DataTransferObjects;

use Carbon\Carbon;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class SubscriptionItemData extends BaseData
{
    public function __construct(
        public ?string $id,
        public string $subscriptionId,
        public string $stripeId,
        public string $stripeProduct,
        public string $stripePrice,
        public string $quantity,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
    ) {
    }
}
