<?php

namespace Domain\Tag\Actions;

use Domain\Tag\Models\Tag;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class DeleteTagAction
{
    use AsAction;

    public function __construct(
        protected Tag $tag
    ) {
    }

    public function handle(string $id): bool
    {
        return QueryBuilder::for($this->tag)
            ->where('id', $id)
            ->delete();
    }
}
