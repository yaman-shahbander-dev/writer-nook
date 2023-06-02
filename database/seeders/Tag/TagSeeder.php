<?php

namespace Database\Seeders\Tag;

use Database\Factories\Tag\TagFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('tags')->truncate();
        TagFactory::new()->count(10)->create();
    }
}
