<?php

namespace Database\Factories\Comment;

use Database\Factories\Article\ArticleFactory;
use Database\Factories\Client\UserFactory;
use Domain\Article\Models\Article;
use Domain\Article\States\Drafted;
use Domain\Client\Models\User;
use Domain\Comment\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Shared\Enums\MorphEnum;


class CommentFactory extends Factory
{
    protected $model = Comment::class;

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
            'commentable_type' => MorphEnum::ARTICLE->value,
            'commentable_id' => $articleId,
            'user_id' => (
                $this->userFactory ??
                $this->user ??
                UserFactory::new()->author()->create()
            )->id,
            'comment' => fake()->sentence(),
            'approved' => 0,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ];
    }
}
