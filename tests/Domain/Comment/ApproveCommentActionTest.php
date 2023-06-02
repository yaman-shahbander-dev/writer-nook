<?php

use Database\Factories\Comment\CommentFactory;
use Domain\Comment\Actions\ApproveCommentAction;

it('tests approve comment action', function () {
    $comment = CommentFactory::new()->create();
    $comment = ApproveCommentAction::run($comment->id);
    expect($comment)->toBeTrue();
});
