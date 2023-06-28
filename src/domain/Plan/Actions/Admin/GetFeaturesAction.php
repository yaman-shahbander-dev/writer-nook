<?php

namespace Domain\Plan\Actions\Admin;

use Domain\Plan\DataTransferObjects\FeatureData;
use Domain\Plan\Models\Feature;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\QueryBuilder;

class GetFeaturesAction
{
    use AsAction;

    public function __construct(
        protected Feature $feature
    ) {
    }

    public function handle(): PaginatedDataCollection
    {
        $feature = QueryBuilder::for($this->feature)
            ->paginate();

        return FeatureData::collection($feature);
    }
}
