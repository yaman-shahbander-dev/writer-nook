<?php

namespace Domain\Plan\Services;

use Domain\Plan\Actions\Admin\CreateFeatureAction;
use Domain\Plan\DataTransferObjects\FeatureData;

class AdminFeatureService
{
    public function store(FeatureData $data)
    {
        return CreateFeatureAction::run($data);
    }
}
