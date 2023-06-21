<?php

namespace Domain\Plan\DataTransferObjects;

use Carbon\Carbon;
use Domain\Client\DataTransferObjects\UserData;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class SubscriptionData extends BaseData
{
    public function __construct(
        public ?string $id,
        public string $userId,
        public string $name,
        public string $stripeId,
        public string $stripeStatus,
        public string $stripePrice,
        public string $quantity,
        public ?Carbon $trialEndsAt,
        public ?Carbon $endsAt,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        #[DataCollectionOf(SubscriptionItemData::class)]
        public ?DataCollection $items,
        public ?UserData $user,
    ) {
    }
}
