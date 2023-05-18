<?php

use Database\Factories\Tag\TagFactory;
use Domain\Tag\Actions\UpdateTagAction;
use Domain\Tag\DataTransferObjects\TagData;

it('updates a new tag from action', function () {
    $tag = TagFactory::new()->create();
    $result = UpdateTagAction::run(TagData::from($tag));
    $this->assertDatabaseCount('tags', 1);
    expect($result)
        ->toBeTrue();
});
