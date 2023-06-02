<?php

use Database\Factories\Comment\CommentFactory;
use Domain\Article\Actions\Shared\CreateCommentAction;
use Domain\Comment\DataTransferObjects\CommentData;

it('tests create comment action', function () {
    $this->assertDatabaseCount('comments', 0);
    $comment = CommentFactory::new()->definition();
    $result = CreateCommentAction::run(CommentData::from($comment));
    expect($result)->toBeTrue();
    $this->assertDatabaseCount('comments', 1);
});
