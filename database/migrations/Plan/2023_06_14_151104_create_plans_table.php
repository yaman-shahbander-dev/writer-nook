<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Domain\Plan\Enums\PlanTypes;
use Domain\Plan\Enums\DurationTypes;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('stripe_price_plan');
            $table->string('type')->default(PlanTypes::BASIC->value);
            $table->string('duration')->default(DurationTypes::MONTH->value);
            $table->timestamp('hidden_at')->nullable();
            $table->string('name');
            $table->text('description');
            $table->decimal('base_price', 10, 8);
            $table->decimal('discount', 10, 8);
            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
