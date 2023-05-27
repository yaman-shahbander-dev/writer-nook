<?php

namespace Domain\Article\Actions\Shared;

use Domain\Article\Models\Article;
use Domain\Article\States\Deleted;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class DeleteArticleAction
{
    use AsAction;

    public function __construct(
        protected Article $article
    ) {
    }

    public function handle(string $id): bool
    {
        $article = QueryBuilder::for($this->article)
            ->where('id', $id)
            ->first();

        if ($article) {
            $article->state->transitionTo(Deleted::class);
            return $article->delete();
        }

        return false;
    }
}
