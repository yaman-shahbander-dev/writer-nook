<?php

namespace Domain\Article\Actions\User;

use Domain\Article\Models\Article;
use Domain\Category\Models\Category;
use Illuminate\Support\Collection;
use Lorisleiva\Actions\Concerns\AsAction;

class SyncCategoriesToArticleAction
{
    use AsAction;

    public function __construct(
        protected Category $category
    ) {
    }

    public function handle(Article $article, array $categories): Collection|null
    {
        if (!empty($article->categories()->sync($categories))) {
            return $this->category->query()->whereIn('id', $categories)->get();
        }

        return null;
    }
}
