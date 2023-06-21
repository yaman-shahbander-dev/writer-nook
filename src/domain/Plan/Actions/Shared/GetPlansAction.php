<?php

namespace Domain\Plan\Actions\Shared;

use Domain\Plan\DataTransferObjects\PlanData;
use Domain\Plan\Models\Plan;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\QueryBuilder;

class GetPlansAction
{
    use AsAction;

    public function __construct(
        protected Plan $plan
    ) {
    }

    public function handle(): PaginatedDataCollection
    {
        $plans = QueryBuilder::for($this->plan)
            ->allowedIncludes(['features', 'userPlans', 'userPlanMonths'])
            ->paginate();

        return PlanData::collection($plans);
    }
}
