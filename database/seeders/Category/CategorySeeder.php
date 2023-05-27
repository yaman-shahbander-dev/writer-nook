<?php

namespace Database\Seeders\Category;

use Database\Factories\Category\CategoryFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();
        CategoryFactory::new()->count(10)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
