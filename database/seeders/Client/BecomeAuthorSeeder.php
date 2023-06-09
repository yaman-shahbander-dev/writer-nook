<?php

namespace Database\Seeders\Client;

use Database\Factories\Client\BecomeAuthorFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BecomeAuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('become_authors')->truncate();
        BecomeAuthorFactory::new()->count(2)->create();
    }
}
