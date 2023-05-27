<?php

namespace Database\Factories\Article;

use Database\Factories\Client\UserFactory;
use Domain\Article\Enums\ArticleStates;
use Domain\Article\Models\Article;
use Domain\Article\States\Drafted;
use Domain\Client\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class ArticleFactory extends Factory
{
    protected $model = Article::class;

    protected UserFactory $userFactory;

    protected User $user;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'user_id' => ($this->userFactory ??
                $this->user ??
                UserFactory::new()->author()->create())->id,
            'title' => fake()->unique()->word(),
            'content' => fake()->sentence(),
            'hashed_content' => base64_encode(fake()->sentence()),
            'excerpt' => fake()->word(),
            'state' => Drafted::getMorphClass(),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ];
    }
}
