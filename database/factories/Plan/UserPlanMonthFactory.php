<?php

namespace Database\Factories\Plan;

use Carbon\Carbon;
use Domain\Plan\Models\Feature;
use Domain\Plan\Models\UserPlan;
use Domain\Plan\Models\UserPlanMonth;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserPlanMonthFactory extends Factory
{
    protected $model = UserPlanMonth::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $feature = Feature::query()->first();

        return [
            'id' => fake()->uuid(),
            'user_plan_id' => UserPlan::query()->first()->id,
            'subscribed_at' => now(),
            'expired_at' => Carbon::make(now())->addMonth(),
            'features' => json_encode([
                'feature_id' => $feature->id,
                'feature_key' => $feature->key,
                'quantity' => fake()->numberBetween(1, 100),
                'quantity_consumed' => fake()->numberBetween(0, 50),
            ]),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ];
    }
}
