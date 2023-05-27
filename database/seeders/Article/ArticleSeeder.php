<?php

namespace Database\Seeders\Article;

use Database\Factories\Article\ArticleFactory;
use Domain\Client\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('articles')->truncate();
        $author = app(User::class)->query()->author()->first();
        ArticleFactory::new([
            'user_id' => $author->id
        ])->count(5)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
