<?php

namespace Domain\Article\Actions\Shared;

use Domain\Article\DataTransferObjects\ArticleData;
use Domain\Article\Models\Article;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class ShowArticleAction
{
    use AsAction;

    public function __construct(
        protected Article $article
    ) {
    }

    public function handle(string $id): ArticleData|null
    {
        $article = QueryBuilder::for($this->article)
            ->where('id', $id)
            ->allowedIncludes([
                'categories',
                'tags',
                'author',
                'comments'
            ])
            ->first();

        return $article ? ArticleData::from($article) : null;
    }
}
