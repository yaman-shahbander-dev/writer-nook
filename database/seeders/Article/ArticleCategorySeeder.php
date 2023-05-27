<?php

namespace Database\Seeders\Article;

use Domain\Article\Models\Article;
use Domain\Category\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('article_category')->truncate();
        $categories = app(Category::class)->query()->get();
        $articles = app(Article::class)->query()->get();
        $articles->each(function ($article) use ($categories) {
            $article->categories()->attach($categories);
        });
    }
}
