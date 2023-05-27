<?php

namespace App\Admin\v1\Http\Article\Resources;

use App\Admin\v1\Http\Category\Resources\CategoryResource;
use App\Admin\v1\Http\Tag\Resources\TagResource;
use App\Helpers\HasPaginatedCollection;
use App\User\v1\Http\Client\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    use HasPaginatedCollection;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'articles',
            'attributes' => [
                'user_id' => $this->userId,
                'title' => $this->title,
                'content' => $this->content,
                'hashed_content' => $this->hashedContent,
                'excerpt' => $this->excerpt,
                'state' => $this->state,
                'created_at' => $this->createdAt,
                'updated_at' => $this->updatedAt,
                'deleted_at' => $this->deletedAt,
            ],
            'relationships' => [
                'categories' => $this->when($this->categories, function () {
                   return CategoryResource::collection($this->categories->items());
                }),
                'tags' => $this->when($this->tags, function () {
                    return TagResource::collection($this->tags->items());
                }),
                'author' => $this->when($this->author, function () {
                    return UserResource::make($this->author);
                }),
            ]
        ];
    }
}
