<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('plan_features')) {
            Schema::table('plan_features', function (Blueprint $table) {
                $table->foreign('feature_id')->references('id')->on('features');
                $table->foreign('plan_id')->references('id')->on('plans');
            });
        }

        if (Schema::hasTable('user_plans')) {
            Schema::table('user_plans', function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('plan_id')->references('id')->on('plans');
            });
        }

        if (Schema::hasTable('user_plan_months')) {
            Schema::table('user_plan_months', function (Blueprint $table) {
                $table->foreign('user_plan_id')->references('id')->on('user_plans');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plan_features', function (Blueprint $table) {
            $table->dropForeign('plan_features_feature_id_foreign');
            $table->dropForeign('plan_features_plan_id_foreign');
        });

        Schema::table('user_plans', function (Blueprint $table) {
            $table->dropForeign('user_plans_user_id_foreign');
            $table->dropForeign('user_plans_plan_id_foreign');
        });

        Schema::table('user_plan_months', function (Blueprint $table) {
            $table->dropForeign('user_plan_months_user_plan_id_foreign');
        });
    }
};
