<?php

namespace Domain\Tag\Actions;

use Domain\Tag\DataTransferObjects\TagData;
use Domain\Tag\Models\Tag;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class GetTagsAction
{
    use AsAction;

    public function __construct(
        protected Tag $tag
    ) {
    }

    public function handle(): PaginatedDataCollection
    {
        $tags = QueryBuilder::for($this->tag)
            ->allowedFilters([
                AllowedFilter::partial('name')
            ])
            ->allowedIncludes(['articles'])
            ->paginate();

        return TagData::collection($tags);
    }
}
