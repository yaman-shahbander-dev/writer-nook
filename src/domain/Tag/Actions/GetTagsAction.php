<?php

namespace Domain\Tag\Actions;

use Domain\Tag\DataTransferObjects\TagData;
use Domain\Tag\Models\Tag;
use Lorisleiva\Actions\Concerns\AsAction;
use Shared\Helpers\PaginatedCollectionData;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class GetTagsAction
{
    use AsAction;

    public function __construct(
        protected Tag $tag
    ) {
    }

    public function handle(): PaginatedCollectionData
    {
        $tags = QueryBuilder::for($this->tag)
            ->allowedFilters([
                AllowedFilter::partial('name')
            ])
            ->jsonPaginate(TagData::class);

        return TagData::paginatedCollection($tags);
    }
}
