<?php

use Database\Factories\Comment\CommentFactory;
use Domain\Comment\Actions\GetCommentsAction;

it('tests get comments action', function () {
    CommentFactory::new()->count(20)->create();
    $comments = GetCommentsAction::run();
    expect($comments)
        ->toBeObject()
        ->each(function ($comment) {
            $comment->toHaveKeys([
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
});
