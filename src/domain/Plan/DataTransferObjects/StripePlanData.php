<?php

namespace Domain\Plan\DataTransferObjects;

use Carbon\Carbon;
use Domain\Plan\Enums\DurationTypes;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class StripePlanData extends BaseData
{
    public function __construct(
        public float $basePrice,
        public ?string $currency,
        public string $duration,
        public string $name,
        public string $description,
    ) {
        $this->currency =  $currency ?: config('payment.cashier.currency');
    }
}
