<?php

namespace Database\Factories\Plan;

use Domain\Plan\Models\PlanFeature;
use Illuminate\Database\Eloquent\Factories\Factory;
use Domain\Plan\Models\Plan;
use Domain\Plan\Models\Feature;

class PlanFeatureFactory extends Factory
{
    protected $model = PlanFeature::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'feature_id' => Feature::query()->first()->id,
            'plan_id' => Plan::query()->first()->id,
            'quantity' => fake()->randomDigitNotZero(),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ];
    }
}
