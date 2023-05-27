<?php

use Database\Factories\Client\UserFactory;
use Database\Factories\Article\ArticleFactory;
use Domain\Article\Actions\User\GetAuthorArticlesAction;

it('gets author\'s articles', function () {
    $author = UserFactory::new()->author()->create();
    ArticleFactory::new(['user_id' => $author->id])->count(10)->create();
    $articles = GetAuthorArticlesAction::run($author);
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
