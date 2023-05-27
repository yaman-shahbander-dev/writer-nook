<?php

use Database\Factories\Article\ArticleFactory;
use Domain\Article\Actions\Shared\DeleteArticleAction;

it('deletes an article', function () {
    $article = ArticleFactory::new()->create();
    $result = DeleteArticleAction::run($article->id);
    expect($result)->toBeTrue();
});
