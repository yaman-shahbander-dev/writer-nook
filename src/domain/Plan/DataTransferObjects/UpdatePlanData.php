<?php

namespace Domain\Plan\DataTransferObjects;

use Carbon\Carbon;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class UpdatePlanData extends BaseData
{
    public function __construct(
        public string $id,
        public string $stripePricePlan,
        public string $stripeProductId,
        public string $type,
        public string $name,
        public string $description,
        public array $features,
    ) {
    }
}
