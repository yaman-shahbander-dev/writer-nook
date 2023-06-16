<?php

namespace App\Admin\v1\Http\Plan\Controllers;

use App\Admin\v1\Http\Plan\Requests\CreatePlanRequest;
use App\Admin\v1\Http\Plan\Resources\PlanResource;
use App\Http\Controllers\Controller;
use Domain\Plan\DataTransferObjects\CreatePlanData;
use Domain\Plan\DataTransferObjects\StripePlanData;
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

    public function store(CreatePlanRequest $request)
    {
        $this->authorize('store', app(Plan::class));

        $data = $request->all();

        DB::beginTransaction();

        try {
            $stripePlan = AdminPlanFacade::createStripePlan(StripePlanData::from($data));
            $data['stripe_price_plan'] = $stripePlan;
            $plan = AdminPlanFacade::createPlan(CreatePlanData::from($data));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        return $plan
            ? $this->okResponse(PlanResource::make($plan))
            : $this->failedResponse();
    }
}
