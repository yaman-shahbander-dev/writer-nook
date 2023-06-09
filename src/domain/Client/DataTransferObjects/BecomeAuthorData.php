<?php

namespace Domain\Client\DataTransferObjects;

use Carbon\Carbon;
use Domain\Client\Enums\UserScopes;
use Domain\Client\Enums\UserTypes;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class BecomeAuthorData extends BaseData
{
    public function __construct(
        public ?string $id,
        public string $title,
        public string $description,
        public ?bool $approved,
        public ?string $user_id,
        public ?UserData $user,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {
    }
}
