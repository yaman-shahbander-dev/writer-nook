<?php

namespace App\Admin\v1\Http\Comment\Resources;

use App\Helpers\HasPaginatedCollection;
use App\User\v1\Http\Client\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    use HasPaginatedCollection;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'comments',
            'attributes' => [
                'commentable_type' => $this->commentableType,
                'commentable_id' => $this->commentableId,
                'user_id' => $this->userId,
                'comment' => $this->comment,
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
