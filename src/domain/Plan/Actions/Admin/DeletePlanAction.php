<?php

namespace Domain\Plan\Actions\Admin;

use Domain\Plan\Models\Plan;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class DeletePlanAction
{
    use AsAction;

    public function __construct(
        protected Plan $plan
    ) {
    }

    public function handle(string $id): bool
    {
        return QueryBuilder::for($this->plan)
            ->where('id', $id)
            ->delete();
    }
}
