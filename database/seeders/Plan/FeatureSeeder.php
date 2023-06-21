<?php

namespace Database\Seeders\Plan;

use Database\Factories\Plan\FeatureFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('features')->truncate();
        FeatureFactory::new()->count(5)->create();
    }
}
