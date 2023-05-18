<?php

namespace Domain\Tag\Actions;

use Domain\Tag\DataTransferObjects\TagData;
use Domain\Tag\Models\Tag;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class ShowTagAction
{
    use AsAction;

    public function __construct(
        protected Tag $tag
    ) {
    }

    public function handle(string $id): TagData|null
    {
        $tag = QueryBuilder::for($this->tag)
            ->where('id', $id)
            ->first();

        return $tag ? TagData::from($tag) : null;
    }
}
