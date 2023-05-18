<?php

use Database\Factories\Tag\TagFactory;
use Domain\Tag\Actions\GetTagsAction;
use Spatie\LaravelData\DataCollection;

it('gets paginated tags from action', function () {
    TagFactory::new()->count(10)->create();
    $tags = GetTagsAction::run();
    expect($tags->data)
        ->toBeInstanceOf(DataCollection::class)
        ->toHaveCount(10)
        ->each(function ($tag) {
            expect($tag)
                ->toBeObject();
        });
});
