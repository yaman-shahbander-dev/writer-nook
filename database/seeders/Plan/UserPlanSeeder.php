<?php

namespace Database\Seeders\Plan;

use Database\Factories\Plan\FeatureFactory;
use Database\Factories\Plan\UserPlanFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('user_plans')->truncate();
        UserPlanFactory::new()->create();
    }
}
