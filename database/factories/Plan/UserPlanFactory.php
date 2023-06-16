<?php

namespace Database\Factories\Plan;

use Carbon\Carbon;
use Domain\Plan\Models\UserPlan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Domain\Plan\Models\Plan;
use Domain\Client\Models\User;

class UserPlanFactory extends Factory
{
    protected $model = UserPlan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'user_id' => User::query()->first()->id,
            'plan_id' => Plan::query()->first()->id,
            'subscribed_at' => now(),
            'expired_at' => Carbon::make(now())->addMonth(),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ];
    }
}
