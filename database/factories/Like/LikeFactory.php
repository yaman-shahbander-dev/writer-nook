<?php

namespace Database\Factories\Like;

use Database\Factories\Article\ArticleFactory;
use Database\Factories\Client\UserFactory;
use Domain\Article\Models\Article;
use Domain\Client\Models\User;
use Domain\Like\Models\Like;
use Illuminate\Database\Eloquent\Factories\Factory;
use Shared\Enums\MorphEnum;


class LikeFactory extends Factory
{
    protected $model = Like::class;

    protected UserFactory $userFactory;
    protected User $user;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $articleId = Article::query()
            ->inRandomOrder()
            ->first()
            ?->id
            ??
            ArticleFactory::new()
                ->create()
                ->id;

        return [
            'id' => fake()->uuid(),
            'likeable_type' => MorphEnum::ARTICLE->value,
            'likeable_id' => $articleId,
            'user_id' => (
                $this->userFactory ??
                $this->user ??
                UserFactory::new()->create()
            )->id,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ];
    }
}
