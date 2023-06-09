<?php

namespace Domain\Client\Actions\Admin;

use App\Exceptions\Client\DataNotFoundException;
use Domain\Client\Models\BecomeAuthor;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class DeleteBecomeAuthorAction
{
    use AsAction;

    public function __construct(
        protected BecomeAuthor $becomeAuthor
    ) {
    }

    public function handle(string $id): DataNotFoundException|bool
    {
        $becomeAuthors = QueryBuilder::for($this->becomeAuthor)
            ->where('id', $id)
            ->whereNull('deleted_at')
            ->first();

        if (!$becomeAuthors) {
            return throw new DataNotFoundException();
        }

        return $becomeAuthors->delete();
    }
}
