<?php

use Database\Factories\Tag\TagFactory;
use Domain\Tag\Actions\CreateTagAction;
use Domain\Tag\DataTransferObjects\TagData;

it('creates a new tag from action', function () {
    $tag = TagFactory::new()->definition();
    $tag = CreateTagAction::run(TagData::from($tag));
    $this->assertDatabaseCount('tags', 1);
    expect($tag)
        ->toBeObject()
        ->toHaveKeys(['id', 'name', 'created_at', 'updated_at', 'deleted_at']);
});
