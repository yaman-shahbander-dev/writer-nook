<?php

namespace Domain\Tag\Actions;

use Domain\Tag\DataTransferObjects\TagData;
use Domain\Tag\Models\Tag;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class CreateTagAction
{
    use AsAction;

    public function __construct(
        protected Tag $tag
    ) {
    }

    public function handle(TagData $data): TagData|null
    {
        $tag = QueryBuilder::for($this->tag)
            ->create([
                'name' => $data->name,
            ]);

        return $tag ? TagData::from($tag) : null;
    }
}
