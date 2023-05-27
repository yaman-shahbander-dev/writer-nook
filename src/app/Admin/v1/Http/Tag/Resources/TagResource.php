<?php

namespace App\Admin\v1\Http\Tag\Resources;

use App\Admin\v1\Http\Article\Resources\ArticleResource;
use App\Helpers\HasPaginatedCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    use HasPaginatedCollection;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'tags',
            'attributes' => [
                'name' => $this->name,
                'created_at' => $this->createdAt,
                'updated_at' => $this->updatedAt,
                'deleted_at' => $this->deletedAt,
            ],
            'relationships' => [
                'articles' => $this->when($this->articles, function () {
                    return ArticleResource::collection($this->articles->items());
                }),
            ]
        ];
    }
}
