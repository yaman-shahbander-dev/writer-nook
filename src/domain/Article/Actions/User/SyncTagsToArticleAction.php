<?php

namespace Domain\Article\Actions\User;

use Domain\Article\Models\Article;
use Domain\Tag\Models\Tag;
use Illuminate\Support\Collection;
use Lorisleiva\Actions\Concerns\AsAction;

class SyncTagsToArticleAction
{
    use AsAction;

    public function __construct(
        protected Tag $tag
    ) {}

    public function handle(Article $article, array $tags): Collection|null
    {
        if (!empty($article->tags()->sync($tags))) {
            return $this->tag->query()->whereIn('id', $tags)->get();
        }

        return null;
    }
}
