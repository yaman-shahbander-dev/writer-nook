<?php

namespace Domain\Plan\Actions\Admin;

use Domain\Plan\Models\Feature;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class DeleteFeatureAction
{
    use AsAction;

    public function __construct(
        protected Feature $feature
    ) {
    }

    public function handle(string $id): bool
    {
        return QueryBuilder::for($this->feature)
            ->where('id', $id)
            ->delete();
    }
}
