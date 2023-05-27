<?php

namespace Domain\Category\Actions;

use Domain\Category\DataTransferObjects\CategoryData;
use Domain\Category\Models\Category;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class GetCategoriesAction
{
    use AsAction;

    public function __construct(
        protected Category $category
    ) {
    }

    public function handle(): PaginatedDataCollection
    {
        $categories = QueryBuilder::for($this->category)
            ->allowedFilters([
                AllowedFilter::partial('name')
            ])
            ->allowedIncludes(['articles'])
            ->paginate();

        return CategoryData::collection($categories);
    }
}
