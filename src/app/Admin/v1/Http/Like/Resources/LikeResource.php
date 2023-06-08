<?php

namespace App\Admin\v1\Http\Like\Resources;

use App\Helpers\HasPaginatedCollection;
use App\User\v1\Http\Client\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LikeResource extends JsonResource
{
    use HasPaginatedCollection;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'likes',
            'attributes' => [
                'likeable_type' => $this->likeableType,
                'likeable_id' => $this->likeableId,
                'user_id' => $this->userId,
                'created_at' => $this->createdAt,
                'updated_at' => $this->updatedAt,
                'deleted_at' => $this->deletedAt,
            ],
            'relationships' => [
                'user' => $this->when($this->user, function () {
                    return UserResource::make($this->user);
                }),
            ]
        ];
    }
}
