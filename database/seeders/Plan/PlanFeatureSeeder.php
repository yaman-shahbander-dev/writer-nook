<?php

namespace Database\Seeders\Plan;

use Domain\Plan\Models\Feature;
use Domain\Plan\Models\Plan;
use Domain\Plan\Models\PlanFeature;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PlanFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('plan_features')->truncate();
        $plans = app(Plan::class)->query()->get();
        $features = app(Feature::class)->query()->get();
        $data = [];

        foreach ($plans as $plan) {
            foreach ($features as $feature) {
                $data[] = [
                    'id' => Str::orderedUuid()->toString(),
                    'feature_id' => $feature->id,
                    'plan_id' => $plan->id,
                    'quantity' => 10
                ];
            }
        }

        PlanFeature::query()->insert($data);
    }
}
