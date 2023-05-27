<?php

namespace Domain\Article\Actions\User;

use Domain\Article\Models\Article;
use Domain\Article\States\Ready;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class UpdateArticleStateToReadyAction
{
    use AsAction;

    public function __construct(protected Article $article) {
    }

    public function handle(string $id): bool
    {
        $article = QueryBuilder::for($this->article)
            ->where('id', $id)
            ->first();

        return !!$article->state->transitionTo(Ready::class);
    }
}
