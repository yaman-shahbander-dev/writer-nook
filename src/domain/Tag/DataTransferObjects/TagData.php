<?php

namespace Domain\Tag\DataTransferObjects;

use Carbon\Carbon;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class TagData extends BaseData
{
    public function __construct(
        public ?string $id,
        public string $name,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt
    ) {
    }
}
