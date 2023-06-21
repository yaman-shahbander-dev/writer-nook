<?php

namespace Database\Factories\Plan;

use Domain\Plan\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Domain\Plan\Enums\PlanTypes;
use Domain\Plan\Enums\DurationTypes;

class PlanFactory extends Factory
{
    protected $model = Plan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'stripe_price_plan' => fake()->uuid(),
            'stripe_product_id' => fake()->uuid(),
            'type' => PlanTypes::BASIC->value,
            'duration' => DurationTypes::MONTH->value,
            'hidden_at' => null,
            'name' => fake()->name(),
            'description' => fake()->sentence(),
            'base_price' => fake()->randomDigitNotZero(),
            'discount' => fake()->randomDigitNotZero(),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ];
    }
}
