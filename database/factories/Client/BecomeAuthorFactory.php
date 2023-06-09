<?php

namespace Database\Factories\Client;

use Domain\Client\Models\BecomeAuthor;
use Domain\Client\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class BecomeAuthorFactory extends Factory
{
    protected $model = BecomeAuthor::class;
    protected User $user;
    protected UserFactory $userFactory;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'title' => fake()->sentence(),
            'description' => fake()->sentence(10),
            'approved' => 0,
            'user_id' => (
                $this->user ??
                $this->userFactory ??
                UserFactory::new()->create()
            )->id,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}
