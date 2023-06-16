<?php

namespace App\Admin\v1\Http\Plan\Resources;

use App\Admin\v1\Http\Plan\Resources\FeatureResource;
use App\Helpers\HasPaginatedCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
{
    use HasPaginatedCollection;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'plans',
            'attributes' => [
                'stripe_price_plan' => $this->stripePricePlan,
                'type' => $this->type,
                'duration' => $this->duration,
                'hidden_at' => $this->hiddenAt,
                'name' => $this->name,
                'description' => $this->description,
                'base_price' => $this->basePrice,
                'discount' => $this->discount,
                'createdAt' => $this->createdAt,
                'updatedAt' => $this->updatedAt,
                'deletedAt' => $this->deletedAt,
            ],
            'relationships' => [
                'features' => $this->when($this->features, function () {
                    return FeatureResource::collection($this->features->items());
                }),
                'user_plans' => $this->when($this->userPlans, function () {
                   return UserPlanResource::collection($this->userPlans->items());
                }),
                'user_plan_months' => $this->when($this->userPlanMonths, function () {
                    return UserPlanMonthResource::collection($this->userPlanMonths->items());
                })
            ]
        ];
    }
}
