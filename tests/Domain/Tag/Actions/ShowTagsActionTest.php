<?php

use Database\Factories\Tag\TagFactory;
use Domain\Tag\Actions\ShowTagAction;

it('gets a category from action', function () {
    $tag = TagFactory::new()->create();
    $tag = ShowTagAction::run($tag->id);
    expect($tag)
        ->toBeObject()
        ->toHaveKeys(['id', 'name', 'created_at', 'updated_at', 'deleted_at']);
});
