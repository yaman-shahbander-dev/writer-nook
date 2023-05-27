<?php

use Database\Factories\Article\ArticleFactory;
use Domain\Article\Actions\User\CreateArticleAction;
use Domain\Article\DataTransferObjects\ArticleData;

it('creates an article', function () {
    $article = ArticleFactory::new()->definition();
    $article = ArticleData::from($article);
    $article = CreateArticleAction::run($article);
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
        ]);
});
