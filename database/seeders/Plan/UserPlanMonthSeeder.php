<?php

namespace Database\Seeders\Plan;

use Database\Factories\Plan\FeatureFactory;
use Database\Factories\Plan\UserPlanFactory;
use Database\Factories\Plan\UserPlanMonthFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPlanMonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('user_plan_months')->truncate();
        UserPlanMonthFactory::new()->count(5)->create();
    }
}
