<?php

namespace Domain\Article\Services;

use Domain\Article\Actions\Admin\ApproveArticleAction;
use Domain\Article\Actions\Shared\DeleteArticleAction;
use Domain\Article\Actions\Shared\GetArticlesAction;
use Domain\Article\Actions\Shared\ShowArticleAction;

class AdminArticleService
{
    public function index()
    {
        return GetArticlesAction::run();
    }

    public function show(string $article)
    {
        return ShowArticleAction::run($article);
    }

    public function approve(string $article)
    {
        return ApproveArticleAction::run($article);
    }

    public function destroy(string $article)
    {
        return DeleteArticleAction::run($article);
    }
}
