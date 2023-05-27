<?php

namespace App\Admin\v1\Http\Category\Resources;

use App\Admin\v1\Http\Article\Resources\ArticleResource;
use App\Helpers\HasPaginatedCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    use HasPaginatedCollection;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'categories',
            'attributes' => [
                'name' => $this->name,
                'main_category_id' => $this->mainCategoryId,
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
