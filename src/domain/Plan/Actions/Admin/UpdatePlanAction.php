<?php

namespace Domain\Plan\Actions\Admin;

use Domain\Plan\DataTransferObjects\UpdatePlanData;
use Domain\Plan\Models\Plan;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class UpdatePlanAction
{
    use AsAction;

    public function __construct(
        protected Plan $plan
    ) {
    }

    public function handle(UpdatePlanData $data): bool
    {
        $plan = tap(QueryBuilder::for($this->plan)->where('id', $data->id))
            ->update([
                'type' => $data->type,
                'name' => $data->name,
                'description' => $data->description,
            ])
            ->first();

        if ($plan) {
            $result = SyncFeaturesAction::run($plan, $data->features);
        }

        return !!$result;
    }
}
