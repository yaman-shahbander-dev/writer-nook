<?php

namespace Domain\Plan\DataTransferObjects;

use Carbon\Carbon;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class UserPlanData extends BaseData
{
    public function __construct(
        public ?string $id,
        public string $userId,
        public string $planId,
        public ?Carbon $subscribedAt,
        public ?Carbon $expiredAt,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {
    }
}
