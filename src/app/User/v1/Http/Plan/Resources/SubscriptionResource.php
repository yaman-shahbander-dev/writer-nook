<?php

namespace App\User\v1\Http\Plan\Resources;

use App\Helpers\HasPaginatedCollection;
use App\User\v1\Http\Client\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    use HasPaginatedCollection;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'subscriptions',
            'attributes' => [
                'user_id' => $this->userId,
                'name' => $this->name,
                'stripe_id' => $this->stripeId,
                'stripe_status' => $this->stripeStatus,
                'stripe_price' => $this->stripePrice,
                'quantity' => $this->quantity,
                'trial_ends_at' => $this->trialEndsAt,
                'ends_at' => $this->endsAt,
                'created_at' => $this->createdAt,
                'updated_at' => $this->updatedAt,
            ],
            'relationships' => [
                'items' => $this->when($this->items, function () {
                    return SubscriptionItemResource::collection($this->items->items());
                }),
                'user' => $this->when($this->user, function () {
                    return UserResource::make($this->user);
                }),
            ]
        ];
    }
}
