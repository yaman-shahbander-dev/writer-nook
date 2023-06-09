<?php

namespace Domain\Client\Actions\Admin;

use Domain\Client\DataTransferObjects\BecomeAuthorData;
use Domain\Client\Models\BecomeAuthor;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\QueryBuilder;

class GetBecomeAuthorsAction
{
    use AsAction;

    public function __construct(
        protected BecomeAuthor $becomeAuthor
    ) {
    }

    public function handle(): PaginatedDataCollection
    {
        $becomeAuthors = QueryBuilder::for($this->becomeAuthor)
            ->allowedIncludes(['user'])
            ->paginate();

        return BecomeAuthorData::collection($becomeAuthors);
    }
}
