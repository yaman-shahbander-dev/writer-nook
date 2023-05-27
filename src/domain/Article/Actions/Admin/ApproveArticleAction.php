<?php

namespace Domain\Article\Actions\Admin;

use App\Exceptions\Client\DataNotFoundException;
use Domain\Article\Models\Article;
use Domain\Article\States\Published;
use Domain\Article\States\Ready;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;
use Domain\Article\Enums\ArticleStates;

class ApproveArticleAction
{
    use AsAction;

    public function __construct(
        protected Article $article
    ) {
    }

    public function handle(string $id): bool
    {
        $article = QueryBuilder::for($this->article)
            ->where([
                'id' => $id,
                'state' => Ready::getMorphClass()
            ])
            ->first();

        if (!$article) throw new DataNotFoundException();

        return !!$article->state->transitionTo(Published::class);
    }
}
