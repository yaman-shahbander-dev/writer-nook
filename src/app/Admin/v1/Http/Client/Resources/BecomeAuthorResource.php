<?php

namespace App\Admin\v1\Http\Client\Resources;

use App\Helpers\HasPaginatedCollection;
use App\User\v1\Http\Client\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BecomeAuthorResource extends JsonResource
{
    use HasPaginatedCollection;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'become-authors',
            'attributes' => [
                'title' => $this->title,
                'description' => $this->description,
                'approved' => $this->approved,
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
