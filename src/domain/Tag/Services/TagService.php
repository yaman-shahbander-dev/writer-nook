<?php

namespace Domain\Tag\Services;

use Domain\Tag\Actions\CreateTagAction;
use Domain\Tag\Actions\DeleteTagAction;
use Domain\Tag\Actions\GetTagsAction;
use Domain\Tag\Actions\ShowTagAction;
use Domain\Tag\Actions\UpdateTagAction;
use Domain\Tag\DataTransferObjects\TagData;

class TagService
{
    public function index() {
        return GetTagsAction::run();
    }

    public function show(string $tag) {
        return ShowTagAction::run($tag);
    }

    public function store(TagData $data) {
        return CreateTagAction::run($data);
    }

    public function update(TagData $data) {
        return UpdateTagAction::run($data);
    }

    public function destroy(string $tag) {
        return DeleteTagAction::run($tag);
    }
}
