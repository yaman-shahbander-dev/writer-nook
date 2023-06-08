<?php

namespace Domain\Like\DataTransferObjects;

use Carbon\Carbon;
use Domain\Client\DataTransferObjects\UserData;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class LikeData extends BaseData
{
    public function __construct(
        public ?string $id,
        public string $likeableType,
        public string $likeableId,
        public string $userId,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
        public ?UserData $user
    ) {
    }
}
