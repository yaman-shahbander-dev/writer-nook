<?php

namespace Domain\Plan\Services;

use Domain\Client\Models\User;
use Domain\Plan\Actions\Admin\CreatePlanAction;
use Domain\Plan\Actions\Admin\CreateStripePlanAction;
use Domain\Plan\Actions\Admin\DeletePlanAction;
use Domain\Plan\Actions\Admin\GetSubscriptionsAction;
use Domain\Plan\Actions\Admin\ShowPlanAction;
use Domain\Plan\Actions\Admin\UpdatePlanAction;
use Domain\Plan\Actions\Shared\CancelSubscriptionAction;
use Domain\Plan\Actions\Shared\GetPlansAction;
use Domain\Plan\Actions\Shared\ResumeSubscriptionAction;
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

    public function getSubscriptions()
    {
        return GetSubscriptionsAction::run();
    }

    public function cancelUserSubscription(string $name, User $user)
    {
        return CancelSubscriptionAction::run($name, $user);
    }

    public function resumeUserSubscription(string $name, User $user)
    {
        return ResumeSubscriptionAction::run($name, $user);
    }
}
