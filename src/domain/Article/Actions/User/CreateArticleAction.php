<?php

namespace Domain\Article\Actions\User;

use Domain\Article\DataTransferObjects\ArticleData;
use Domain\Article\Models\Article;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class CreateArticleAction
{
    use AsAction;

    public function __construct(protected Article $article) {
    }

    public function handle(ArticleData $article): Article|QueryBuilder
    {
        return QueryBuilder::for($this->article)
            ->create([
                'user_id' => $article->userId,
                'title' => $article->title,
                'content' => $article->content,
                'hashed_content' => $article->hashedContent,
                'excerpt' => $article->userId,
            ]);
    }
}
