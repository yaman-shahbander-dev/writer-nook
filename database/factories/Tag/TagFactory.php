<?php

namespace Database\Factories\Tag;

use Domain\Tag\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;


class TagFactory extends Factory
{
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'name' => fake()->name(),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ];
    }
}
