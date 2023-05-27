<?php

use Database\Factories\Article\ArticleFactory;
use Domain\Article\Actions\Shared\GetArticlesAction;

it('gets articles', function () {
    $articles = GetArticlesAction::run();
    expect($articles)
        ->toBeObject()
        ->each(function ($article) {
            $article->toHaveKeys([
                'id',
                'user_id',
                'title',
                'content',
                'hashed_content',
                'excerpt',
                'created_at',
                'updated_at',
                'deleted_at',
                'author',
                'categories',
                'tags'
            ]);
        });
});
