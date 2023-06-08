<?php

use Database\Factories\Article\ArticleFactory;
use Domain\Article\Actions\User\LikeOrUnlikeAction;
use Database\Factories\Client\UserFactory;
use Domain\Like\DataTransferObjects\LikeData;
use Shared\Enums\MorphEnum;

it('likes an article', function () {
    $article = ArticleFactory::new()->create();
    $user = UserFactory::new()->create();
    $data = [
        'user_id' => $user->id,
        'likeable_type' => MorphEnum::ARTICLE->value,
        'likeable_id' => $article->id
    ];
    $result = LikeOrUnlikeAction::run(LikeData::from($data));
    expect($result)->toBeTrue();
});
