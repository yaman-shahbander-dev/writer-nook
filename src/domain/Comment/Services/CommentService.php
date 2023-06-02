<?php

namespace Domain\Comment\Services;

use Domain\Comment\Actions\ApproveCommentAction;
use Domain\Comment\Actions\DeleteCommentAction;
use Domain\Comment\Actions\GetCommentsAction;
use Domain\Comment\Actions\ShowCommentAction;

class CommentService
{
    public function index()
    {
        return GetCommentsAction::run();
    }

    public function show(string $commentId)
    {
        return ShowCommentAction::run($commentId);
    }

    public function approve(string $commentId)
    {
        return ApproveCommentAction::run($commentId);
    }

    public function destroy(string $commentId)
    {
        return DeleteCommentAction::run($commentId);
    }
}
