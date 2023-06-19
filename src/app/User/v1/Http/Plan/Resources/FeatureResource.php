<?php

namespace App\User\v1\Http\Plan\Resources;

use App\Helpers\HasPaginatedCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeatureResource extends JsonResource
{
    use HasPaginatedCollection;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'features',
            'attributes' => [
                'name' => $this->name,
                'key' => $this->key,
                'description' => $this->description,
                'createdAt' => $this->createdAt,
                'updatedAt' => $this->updatedAt,
                'deletedAt' => $this->deletedAt,
            ],
            'relationships' => [
            ]
        ];
    }
}
