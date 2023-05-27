<?php

namespace Domain\Tag\DataTransferObjects;

use Carbon\Carbon;
use Domain\Article\DataTransferObjects\ArticleData;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class TagData extends BaseData
{
    public function __construct(
        public ?string $id,
        public ?string $name,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
        #[DataCollectionOf(ArticleData::class)]
        public ?DataCollection $articles,
    ) {
    }
}
