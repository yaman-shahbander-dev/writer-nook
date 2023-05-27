<?php

use Database\Factories\Article\ArticleFactory;
use Domain\Article\Actions\Shared\ShowArticleAction;

it('shows an article', function () {
    $article = ArticleFactory::new()->create();
    $article = ShowArticleAction::run($article->id);
    expect($article)
        ->toBeObject()
        ->toHaveKeys([
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
