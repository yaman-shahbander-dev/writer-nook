<?php

namespace Database\Seeders\Article;

use Domain\Article\Models\Article;
use Domain\Tag\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('article_tag')->truncate();
        $tags = app(Tag::class)->query()->get();
        $articles = app(Article::class)->query()->get();
        $articles->each(function ($article) use ($tags) {
            $article->tags()->attach($tags);
        });
    }
}
