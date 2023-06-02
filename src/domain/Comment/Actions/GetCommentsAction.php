<?php

namespace Domain\Comment\Actions;

use Domain\Comment\DataTransferObjects\CommentData;
use Domain\Comment\Models\Comment;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class GetCommentsAction
{
    use AsAction;

    public function __construct(
        protected Comment $comment
    ) {
    }

    public function handle(): PaginatedDataCollection
    {
        $comments = QueryBuilder::for($this->comment)
            ->allowedFilters([
                AllowedFilter::partial('comment')
            ])
            ->allowedIncludes(['user'])
            ->paginate();

        return CommentData::collection($comments);
    }
}
