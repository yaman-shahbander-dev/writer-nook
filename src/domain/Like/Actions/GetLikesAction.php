<?php

namespace Domain\Like\Actions;

use Domain\Like\DataTransferObjects\LikeData;
use Domain\Like\Models\Like;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\QueryBuilder;

class GetLikesAction
{
    use AsAction;

    public function __construct(
        protected Like $like
    ) {
    }

    public function handle(): PaginatedDataCollection
    {
        $likes = QueryBuilder::for($this->like)
            ->allowedIncludes(['user'])
            ->paginate();

        return LikeData::collection($likes);
    }
}
