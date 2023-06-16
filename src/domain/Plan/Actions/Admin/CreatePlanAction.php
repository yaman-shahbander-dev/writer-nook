<?php

namespace Domain\Plan\Actions\Admin;

use Domain\Plan\DataTransferObjects\CreatePlanData;
use Domain\Plan\DataTransferObjects\PlanData;
use Domain\Plan\DataTransferObjects\PlanFeatureData;
use Domain\Plan\Models\Plan;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class CreatePlanAction
{
    use AsAction;

    public function __construct(
        protected Plan $plan
    ) {
    }

    public function handle(CreatePlanData $data)//: Plan|QueryBuilder
    {
        $plan = QueryBuilder::for($this->plan)
            ->create([
                'stripe_price_plan' => $data->stripePricePlan,
                'type' => $data->type,
                'duration' => $data->duration,
                'name' => $data->name,
                'description' => $data->description,
                'base_price' => $data->basePrice,
                'discount' => $data->discount,
            ]);

        $features = SyncFeaturesAction::run($plan, $data->features);

        $plan = PlanData::from($plan);
        $plan->features = $features;

        return $plan;
    }
}
