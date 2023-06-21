<?php

namespace Domain\Plan\Actions\Admin;

use Domain\Plan\DataTransferObjects\FeatureData;
use Domain\Plan\Models\Feature;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class CreateFeatureAction
{
    use AsAction;

    public function __construct(
        protected Feature $feature
    ) {
    }

    public function handle(FeatureData $data): FeatureData
    {
        $feature = QueryBuilder::for($this->feature)
            ->create([
                'name' => $data->name,
                'key' => $data->key,
                'description' => $data->description,
            ]);

        return FeatureData::from($feature);
    }
}
