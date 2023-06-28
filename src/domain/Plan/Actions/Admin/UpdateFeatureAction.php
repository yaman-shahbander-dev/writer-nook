<?php

namespace Domain\Plan\Actions\Admin;

use Domain\Plan\DataTransferObjects\FeatureData;
use Domain\Plan\Models\Feature;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class UpdateFeatureAction
{
    use AsAction;

    public function __construct(
        protected Feature $feature
    ) {
    }

    public function handle(FeatureData $data): bool
    {
        return QueryBuilder::for($this->feature)
            ->where('id', $data->id)
            ->update([
                'name' => $data->name,
                'key' => $data->key,
                'description' => $data->description,
            ]);
    }
}
