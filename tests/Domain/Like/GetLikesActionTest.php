<?php

use Database\Factories\Like\LikeFactory;
use Domain\Like\Actions\GetLikesAction;

it('gets paginated likes from the action', function () {
    LikeFactory::new()->count(20)->create();
    $likes = GetLikesAction::run();
    expect($likes)
        ->toHaveCount(15)
        ->each(function ($like) {
           expect($like)
               ->toBeObject();
        });
});
