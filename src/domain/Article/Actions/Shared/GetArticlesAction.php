<?php

namespace Domain\Article\Actions\Shared;

use Domain\Article\DataTransferObjects\ArticleData;
use Domain\Article\Models\Article;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class GetArticlesAction
{
    use AsAction;

    public function __construct(
        protected Article $article
    ) {
    }

    public function handle(): PaginatedDataCollection
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
            ->paginate();

        $articlesWithImages = $articles->getCollection()->map(function ($article) {
            $article->setAttribute('image_url', $article->getFirstMediaUrl('article-image'));
            return $article;
        });

        $articles->setCollection($articlesWithImages);

        return ArticleData::collection($articles);
    }
}
