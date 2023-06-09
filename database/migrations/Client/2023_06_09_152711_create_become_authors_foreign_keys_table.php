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
        if (Schema::hasTable('become_authors')) {
            Schema::table('become_authors', function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('become_authors', function (Blueprint $table) {
            $table->dropForeign('become_authors_user_id_foreign');
        });
    }
};
