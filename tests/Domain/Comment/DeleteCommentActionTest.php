<?php

use Database\Factories\Comment\CommentFactory;
use Domain\Comment\Actions\DeleteCommentAction;

it('tests delete comment action', function () {
    $comment = CommentFactory::new()->create();
    $comment = DeleteCommentAction::run($comment->id);
    expect($comment)->toBeTrue();
});
