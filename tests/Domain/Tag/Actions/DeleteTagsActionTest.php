<?php

use Database\Factories\Tag\TagFactory;
use Domain\Tag\Actions\DeleteTagAction;

it('deletes a tag from action', function () {
    $tag = TagFactory::new()->create();
    $result = DeleteTagAction::run($tag->id);
    $this->assertSoftDeleted($tag);
    expect($result)
        ->toBeTrue();
});
