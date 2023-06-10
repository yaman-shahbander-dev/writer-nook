<?php

namespace Domain\Article\DataTransferObjects;

use Carbon\Carbon;
use Domain\Article\Enums\ArticleStates;
use Domain\Category\DataTransferObjects\CategoryData;
use Domain\Client\DataTransferObjects\AuthorData;
use Domain\Comment\DataTransferObjects\CommentData;
use Domain\Tag\DataTransferObjects\TagData;
use Illuminate\Http\UploadedFile;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ArticleData extends BaseData
{
    public function __construct(
        public ?string $id,
        public ?string $userId,
        public ?string $title,
        public ?string $content,
        public ?string $hashedContent,
        public ?string $excerpt,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
        public ?AuthorData $author,
        #[DataCollectionOf(TagData::class)]
        public ?DataCollection $tags,
        #[DataCollectionOf(CategoryData::class)]
        public ?DataCollection $categories,
        #[DataCollectionOf(CommentData::class)]
        public ?DataCollection $comments,
        public ?string $imageUrl,
        public ?string $state = ArticleStates::DRAFTED->value,
    ) {
    }
}
