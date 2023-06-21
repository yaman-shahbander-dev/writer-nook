<?php

namespace App\Admin\v1\Http\Plan\Resources;

use App\Helpers\HasPaginatedCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionItemResource extends JsonResource
{
    use HasPaginatedCollection;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'subscription-items',
            'attributes' => [
                'subscription_id' => $this->userId,
                'stripe_id' => $this->stripeId,
                'stripe_product' => $this->stripeProduct,
                'stripe_price' => $this->stripePrice,
                'quantity' => $this->quantity,
                'created_at' => $this->createdAt,
                'updated_at' => $this->updatedAt,
            ],
            'relationships' => [
            ]
        ];
    }
}
