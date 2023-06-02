<?php

namespace Domain\Article\Services;

use Domain\Article\Actions\Shared\CreateCommentAction;
use Domain\Article\Actions\Shared\DeleteArticleAction;
use Domain\Article\Actions\Shared\GetArticlesAction;
use Domain\Article\Actions\Shared\ShowArticleAction;
use Domain\Article\Actions\User\DirectorArticleAction;
use Domain\Article\Actions\User\GetAuthorArticlesAction;
use Domain\Article\Actions\User\UpdateArticleAction;
use Domain\Article\Actions\User\UpdateArticleStateToReadyAction;
use Domain\Article\DataTransferObjects\ArticleData;
use Domain\Client\Models\User;
use Domain\Comment\DataTransferObjects\CommentData;

class ArticleService
{
    public function index()
    {
        return GetArticlesAction::run();
    }

    public function show(string $article)
    {
        return ShowArticleAction::run($article);
    }

    public function store(array $data)
    {
        return DirectorArticleAction::run($data);
    }

    public function update(ArticleData $data)
    {
        return UpdateArticleAction::run($data);
    }

    public function destroy(string $articleId)
    {
        return DeleteArticleAction::run($articleId);
    }

    public function getAuthorArticles(User $user)
    {
        return GetAuthorArticlesAction::run($user);
    }

    public function ready(string $articleId)
    {
        return UpdateArticleStateToReadyAction::run($articleId);
    }

    public function createComment(CommentData $data)
    {
        return CreateCommentAction::run($data);
    }
}
