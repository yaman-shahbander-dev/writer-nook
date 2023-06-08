<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\Article\ArticleCategorySeeder;
use Database\Seeders\Article\ArticleSeeder;
use Database\Seeders\Article\ArticleTagSeeder;
use Database\Seeders\Category\CategorySeeder;
use Database\Seeders\Client\AdminPermissionSeeder;
use Database\Seeders\Client\AuthorPermissionSeeder;
use Database\Seeders\Client\PermissionSeeder;
use Database\Seeders\Client\RolePermissionSeeder;
use Database\Seeders\Client\UserPermissionSeeder;
use Database\Seeders\Client\UserSeeder;
use Database\Seeders\Comment\CommentSeeder;
use Database\Seeders\Like\LikeSeeder;
use Database\Seeders\Tag\TagSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /*
    |--------------------------------------------------------------------------
    | Seeding Strategy
    |--------------------------------------------------------------------------
    |
    | In order to maintain your seeders working even after production, try to check for seeded data
    | existence in the database before seeding it. This can help you in development to avoid
    | a database refreshing when seeding new data and will also prevent duplicated data.
    |
    */

    public function run(): void
    {
        $seeders = [
            UserSeeder::class,
            CategorySeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            AdminPermissionSeeder::class,
            AuthorPermissionSeeder::class,
            UserPermissionSeeder::class,
            TagSeeder::class,
            ArticleSeeder::class,
            ArticleCategorySeeder::class,
            ArticleTagSeeder::class,
            CommentSeeder::class,
            LikeSeeder::class,
        ];



        /*
        |--------------------------------------------------------------------------
        | Disable ForeignKey Constraints
        |--------------------------------------------------------------------------
        |
        | Disabling foreign key constraints give flexibility to your testing seeders, but
        | it may result data inconsistency. so be careful if you decide to disable them.
        |
        */

        if (app()->environment(['local', 'staging', 'testing'])) {
            Schema::disableForeignKeyConstraints();
            $this->call($seeders);
            Schema::enableForeignKeyConstraints();
        }
    }
}
