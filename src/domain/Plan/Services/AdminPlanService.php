<?php

namespace Domain\Plan\Services;

use Domain\Plan\Actions\Admin\CreatePlanAction;
use Domain\Plan\Actions\Admin\CreateStripePlanAction;
use Domain\Plan\Actions\Admin\DeletePlanAction;
use Domain\Plan\Actions\Admin\ShowPlanAction;
use Domain\Plan\Actions\Admin\UpdatePlanAction;
use Domain\Plan\Actions\Shared\GetPlansAction;
use Domain\Plan\DataTransferObjects\CreatePlanData;
use Domain\Plan\DataTransferObjects\StripePlanData;
use Domain\Plan\DataTransferObjects\UpdatePlanData;

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

    public function updatePlan(UpdatePlanData $data)
    {
        return UpdatePlanAction::run($data);
    }

    public function delete(string $planId)
    {
        return DeletePlanAction::run($planId);
    }
}
