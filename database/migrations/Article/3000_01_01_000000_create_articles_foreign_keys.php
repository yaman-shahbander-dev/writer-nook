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
        if (Schema::hasTable('articles')) {
            Schema::table('articles', function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users');
            });
        }
        if (Schema::hasTable('article_category')) {
            Schema::table('article_category', function (Blueprint $table) {
                $table->foreign('article_id')->references('id')->on('articles');
                $table->foreign('category_id')->references('id')->on('categories');
            });
        }
        if (Schema::hasTable('article_tag')) {
            Schema::table('article_tag', function (Blueprint $table) {
                $table->foreign('article_id')->references('id')->on('articles');
                $table->foreign('tag_id')->references('id')->on('tags');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign('articles_user_id_foreign');
        });
        Schema::table('article_category', function (Blueprint $table) {
            $table->dropForeign('article_category_article_id_foreign');
            $table->dropForeign('article_category_category_id_foreign');
        });
        Schema::table('article_tag', function (Blueprint $table) {
            $table->dropForeign('article_tag_article_id_foreign');
            $table->dropForeign('article_tag_tag_id_foreign');
        });
    }
};
