<?php

namespace Domain\Plan\Services;

use Domain\Plan\Actions\Admin\CreatePlanAction;
use Domain\Plan\Actions\Admin\CreateStripePlanAction;
use Domain\Plan\Actions\Admin\GetPlansAction;
use Domain\Plan\Actions\Admin\ShowPlanAction;
use Domain\Plan\DataTransferObjects\CreatePlanData;
use Domain\Plan\DataTransferObjects\StripePlanData;

class AdminPlanService
{
    public function index()
    {
        return GetPlansAction::run();
    }

    public function show(string $planId)
    {
        return ShowPlanAction::run($planId);
    }

    public function createStripePlan(StripePlanData $data)
    {
        return CreateStripePlanAction::run($data);
    }

    public function createPlan(CreatePlanData $data)
    {
        return CreatePlanAction::run($data);
    }
}
