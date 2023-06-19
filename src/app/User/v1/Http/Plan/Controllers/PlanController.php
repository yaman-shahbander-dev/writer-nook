<?php

namespace App\User\v1\Http\Plan\Controllers;

use App\User\v1\Http\Plan\Requests\SubscribeRequest;
use App\User\v1\Http\Plan\Resources\PlanResource;
use App\Http\Controllers\Controller;
use Domain\Plan\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Domain\Plan\Facades\UserPlanFacade;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    public function index(): JsonResponse
    {
        $this->authorize('view', app(Plan::class));

        $plans = UserPlanFacade::index();

        return PlanResource::paginatedCollection($plans);
    }

    public function checkout(Request $request, Plan $plan): JsonResponse
    {
        $this->authorize('checkout', app(Plan::class));

        $data = UserPlanFacade::checkout($plan->id, $request->user());

        return $data
            ? $this->okResponse($data)
            : $this->failedResponse();
    }

    public function subscribe(SubscribeRequest $request, Plan $plan): JsonResponse
    {
        $this->authorize('subscribe', app(Plan::class));

        DB::beginTransaction();

        try {
            $result = UserPlanFacade::subscribe($request->user(), $plan, $request->payment_method);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }
}
