<?php

namespace Domain\Tag\Actions;

use Domain\Tag\DataTransferObjects\TagData;
use Domain\Tag\Models\Tag;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class UpdateTagAction
{
    use AsAction;

    public function __construct(
        protected Tag $tag
    ) {
    }

    public function handle(TagData $data): bool
    {
        return QueryBuilder::for($this->tag)
            ->where('id', $data->id)
            ->update([
                'name' => $data->name
            ]);
    }
}
