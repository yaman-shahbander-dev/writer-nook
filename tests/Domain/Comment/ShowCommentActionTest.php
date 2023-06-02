<?php

use Database\Factories\Comment\CommentFactory;
use Domain\Comment\Actions\ShowCommentAction;

it('tests show comment action', function () {
    $comment = CommentFactory::new()->create();
    $comment = ShowCommentAction::run($comment->id);
    expect($comment)
        ->toBeObject()
        ->toHaveKeys([
            'id',
            'commentable_type',
            'commentable_id',
            'user_id',
            'comment',
            'created_at',
            'updated_at',
            'deleted_at',
            'user',
        ]);
});
