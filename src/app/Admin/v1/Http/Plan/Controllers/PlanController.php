<?php

namespace App\Admin\v1\Http\Plan\Controllers;

use App\Admin\v1\Http\Plan\Requests\CancelSubscriptionRequest;
use App\Admin\v1\Http\Plan\Requests\CreatePlanRequest;
use App\Admin\v1\Http\Plan\Requests\ResumeSubscriptionRequest;
use App\Admin\v1\Http\Plan\Requests\UpdatePlanRequest;
use App\Admin\v1\Http\Plan\Resources\PlanResource;
use App\Admin\v1\Http\Plan\Resources\SubscriptionResource;
use App\Http\Controllers\Controller;
use Domain\Client\Models\User;
use Domain\Plan\DataTransferObjects\CreatePlanData;
use Domain\Plan\DataTransferObjects\StripePlanData;
use Domain\Plan\DataTransferObjects\UpdatePlanData;
use Domain\Plan\Facades\AdminPlanFacade;
use Domain\Plan\Models\Plan;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    public function index(): JsonResponse
    {
        $this->authorize('view', app(Plan::class));

        $plans = AdminPlanFacade::index();

        return PlanResource::paginatedCollection($plans);
    }

    public function show(Plan $plan): JsonResponse
    {
        $this->authorize('view', app(Plan::class));

        $plan = AdminPlanFacade::show($plan->id);

        return $plan
            ? $this->okResponse(PlanResource::make($plan))
            : $this->notFoundResponse();
    }

    public function store(CreatePlanRequest $request): JsonResponse
    {
        $this->authorize('store', app(Plan::class));

        $data = $request->all();

        DB::beginTransaction();

        try {
            $stripeData = AdminPlanFacade::createStripePlan(StripePlanData::from($data));
            $data['stripe_price_plan'] = $stripeData['stripe_price_plan'];
            $data['stripe_product_id'] = $stripeData['stripe_product_id'];

            $plan = AdminPlanFacade::createPlan(CreatePlanData::from($data));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        return $plan
            ? $this->okResponse(PlanResource::make($plan))
            : $this->failedResponse();
    }

    public function update(UpdatePlanRequest $request, Plan $plan): JsonResponse
    {
        $this->authorize('update', $plan);

        $result = AdminPlanFacade::updatePlan(UpdatePlanData::from($request->all()));

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }

    public function destroy(Plan $plan): JsonResponse
    {
        $this->authorize('delete', $plan);

        $result = AdminPlanFacade::delete($plan->id);

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }

    public function getSubscriptions(): JsonResponse
    {
        $this->authorize('view', app(Plan::class));

        $subscriptions = AdminPlanFacade::getSubscriptions();

        return SubscriptionResource::paginatedCollection($subscriptions);
    }

    public function cancelUserSubscription(CancelSubscriptionRequest $request, User $user): JsonResponse
    {
        $this->authorize('cancel', app(Plan::class));

        $result = AdminPlanFacade::cancelUserSubscription($request->name, $user);

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }

    public function resumeUserSubscription(ResumeSubscriptionRequest $request, User $user): JsonResponse
    {
        $this->authorize('cancel', app(Plan::class));

        $result = AdminPlanFacade::resumeUserSubscription($request->name, $user);

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }
}
