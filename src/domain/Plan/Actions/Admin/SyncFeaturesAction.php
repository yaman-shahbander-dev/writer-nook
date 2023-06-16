<?php

namespace Domain\Plan\Actions\Admin;

use Domain\Plan\DataTransferObjects\FeatureData;
use Domain\Plan\Models\Feature;
use Domain\Plan\Models\Plan;
use Domain\Plan\Models\PlanFeature;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\DataCollection;

class SyncFeaturesAction
{
    use AsAction;

    public function __construct(
        protected Feature $feature
    ) {
    }

    public function handle(Plan $plan, array $features): DataCollection|null
    {
        $data = [];
        foreach ($features as $feature) {
            $data[$feature['id']] = ['quantity' => $feature['quantity']];
        }

        if (!empty($plan->features()->sync($data))) {
            return FeatureData::collection(
                $this->feature
                    ->query()
                    ->whereIn('id', array_keys($data))
                    ->get()
            );
        }

        return null;
    }
}
