<?php

namespace Database\Seeders\Comment;

use Database\Factories\Comment\CommentFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('comments')->truncate();
        CommentFactory::new()->count(10)->create();
    }
}
