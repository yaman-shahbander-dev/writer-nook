<?php

namespace Domain\Comment\DataTransferObjects;

use Carbon\Carbon;
use Domain\Client\DataTransferObjects\UserData;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class CommentData extends BaseData
{
    public function __construct(
        public ?string $id,
        public string $commentableType,
        public string $commentableId,
        public string $userId,
        public string $comment,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
        public ?UserData $user
    ) {
    }
}
