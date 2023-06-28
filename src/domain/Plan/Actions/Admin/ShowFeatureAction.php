<?php

namespace Domain\Plan\Actions\Admin;

use Domain\Plan\DataTransferObjects\FeatureData;
use Domain\Plan\Models\Feature;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class ShowFeatureAction
{
    use AsAction;

    public function __construct(
        protected Feature $feature
    ) {
    }

    public function handle(string $id): FeatureData
    {
        $feature = QueryBuilder::for($this->feature)
            ->where('id', $id)
            ->first();

        return FeatureData::from($feature);
    }
}
