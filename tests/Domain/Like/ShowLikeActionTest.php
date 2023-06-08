<?php

use Database\Factories\Like\LikeFactory;
use Domain\Like\Actions\ShowLikeAction;

it('shows a like from the action', function () {
    $like = LikeFactory::new()->create();
    $like = ShowLikeAction::run($like->id);
    expect($like)
        ->toBeObject()
        ->toHaveKeys([
            'id',
            'likeable_type',
            'likeable_id',
            'user_id',
            'created_at',
            'updated_at',
            'deleted_at',
            'user',
        ]);
});
