<?php

namespace Domain\Article\Actions\User;

use Domain\Article\DataTransferObjects\ArticleData;
use Domain\Article\Models\Article;
use Domain\Client\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class GetAuthorArticlesAction
{
    use AsAction;

    public function __construct(
        protected Article $article
    ) {
    }

    public function handle(User $user): PaginatedDataCollection
    {
        $articles = QueryBuilder::for($this->article)
            ->allowedFilters([
                AllowedFilter::partial('title'),
                AllowedFilter::partial('content'),
                AllowedFilter::partial('excerpt'),
                AllowedFilter::partial('state'),
            ])
            ->allowedIncludes([
                'author',
                'tags',
                'categories',
                'comments'
            ])
            ->where('user_id', $user->id)
            ->paginate();

        return ArticleData::collection($articles);
    }
}
