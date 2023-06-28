<?php

namespace Domain\Plan\Services;

use Domain\Plan\Actions\Admin\CreateFeatureAction;
use Domain\Plan\Actions\Admin\DeleteFeatureAction;
use Domain\Plan\Actions\Admin\GetFeaturesAction;
use Domain\Plan\Actions\Admin\ShowFeatureAction;
use Domain\Plan\Actions\Admin\UpdateFeatureAction;
use Domain\Plan\DataTransferObjects\FeatureData;

class AdminFeatureService
{
    public function index()
    {
        return GetFeaturesAction::run();
    }

    public function show(string $featureId)
    {
        return ShowFeatureAction::run($featureId);
    }

    public function store(FeatureData $data)
    {
        return CreateFeatureAction::run($data);
    }

    public function update(FeatureData $data)
    {
        return UpdateFeatureAction::run($data);
    }

    public function delete(string $featureId)
    {
        return DeleteFeatureAction::run($featureId);
    }
}
