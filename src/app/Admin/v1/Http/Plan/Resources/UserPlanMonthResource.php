<?php

namespace App\Admin\v1\Http\Plan\Resources;

use App\Helpers\HasPaginatedCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserPlanMonthResource extends JsonResource
{
    use HasPaginatedCollection;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'user-plan-months',
            'attributes' => [
                'user_plan_id' => $this->userPlanId,
                'subscribed_at' => $this->subscribedAt,
                'expired_at' => $this->expiredAt,
                'features' => $this->features,
                'createdAt' => $this->createdAt,
                'updatedAt' => $this->updatedAt,
                'deletedAt' => $this->deletedAt,
            ],
            'relationships' => [
            ]
        ];
    }
}
