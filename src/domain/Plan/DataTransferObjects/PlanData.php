<?php

namespace Domain\Plan\DataTransferObjects;

use Carbon\Carbon;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class PlanData extends BaseData
{
    public function __construct(
        public ?string $id,
        public string $stripePricePlan,
        public string $stripeProductId,
        public string $type,
        public string $duration,
        public ?Carbon $hiddenAt,
        public string $name,
        public string $description,
        public float $basePrice,
        public float $discount,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
        #[DataCollectionOf(FeatureData::class)]
        public ?DataCollection $features,
        #[DataCollectionOf(UserPlanData::class)]
        public ?DataCollection $userPlans,
        #[DataCollectionOf(UserPlanMonthData::class)]
        public ?DataCollection $userPlanMonths
    ) {
    }
}
