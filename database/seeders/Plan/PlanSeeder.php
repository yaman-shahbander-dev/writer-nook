<?php

namespace Database\Seeders\Plan;

use Database\Factories\Plan\PlanFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('plans')->truncate();
        PlanFactory::new()->count(3)->create();
    }
}
