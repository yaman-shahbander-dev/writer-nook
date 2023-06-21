<?php

namespace App\Admin\v1\Http\Plan\Resources;

use App\Helpers\HasPaginatedCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserPlanResource extends JsonResource
{
    use HasPaginatedCollection;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'user-plans',
            'attributes' => [
                'user_id' => $this->userId,
                'plan_id' => $this->planId,
                'subscribed_at' => $this->subscribedAt,
                'expired_at' => $this->expiredAt,
                'createdAt' => $this->createdAt,
                'updatedAt' => $this->updatedAt,
                'deletedAt' => $this->deletedAt,
            ],
            'relationships' => [
            ]
        ];
    }
}
