<?php

namespace Domain\Plan\Actions\Admin;

use Domain\Plan\DataTransferObjects\PlanData;
use Domain\Plan\Models\Plan;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class ShowPlanAction
{
    use AsAction;

    public function __construct(
        protected Plan $plan
    ) {
    }

    public function handle(string $id): ?PlanData
    {
        $plans = QueryBuilder::for($this->plan)
            ->where('id', $id)
            ->allowedIncludes(['features', 'userPlans', 'userPlanMonths'])
            ->first();

        return PlanData::from($plans);
    }
}
