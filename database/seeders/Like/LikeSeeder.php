<?php

namespace Database\Seeders\Like;

use Database\Factories\Like\LikeFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('likes')->truncate();
        LikeFactory::new()->count(10)->create();
    }
}
