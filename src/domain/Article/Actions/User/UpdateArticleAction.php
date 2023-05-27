<?php

namespace Domain\Article\Actions\User;

use Domain\Article\DataTransferObjects\ArticleData;
use Domain\Article\Models\Article;
use Domain\Article\States\Drafted;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class UpdateArticleAction
{
    use AsAction;

    public function __construct(protected Article $article) {
    }

    public function handle(ArticleData $data): bool
    {
        $article = tap(
            QueryBuilder::for($this->article)->where('id', $data->id)
        )
            ->update([
                'title' => $data->title,
                'content' => $data->content,
                'hashed_content' => $data->hashedContent,
                'excerpt' => $data->excerpt,
            ])
            ->first();

        if ($article) {
            $categories = SyncCategoriesToArticleAction::run($article, getIds($data->categories));
            $tags = SyncTagsToArticleAction::run($article, getIds($data->tags));
            $article->state->transitionTo(Drafted::getMorphClass());
            return !empty($categories) && !empty($tags);
        }

        return false;
    }
}
