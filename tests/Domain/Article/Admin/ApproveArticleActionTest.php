<?php

use Database\Factories\Article\ArticleFactory;
use Domain\Article\Actions\Admin\ApproveArticleAction;
use Domain\Article\States\Ready;

it('approves an article by the admin', function () {
   $article = ArticleFactory::new(['state' => Ready::getMorphClass()])->create();
   $result = ApproveArticleAction::run($article->id);
   expect($result)->toBeTrue();
});
