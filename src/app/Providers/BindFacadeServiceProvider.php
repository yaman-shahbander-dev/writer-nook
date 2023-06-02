<?php

namespace App\Providers;

use Domain\Article\Services\AdminArticleService;
use Domain\Article\Services\ArticleService;
use Domain\Category\Services\CategoryService;
use Domain\Client\Services\AdminAuthService;
use Domain\Client\Services\UserAuthService;
use Domain\Comment\Services\CommentService;
use Domain\Tag\Services\TagService;
use Illuminate\Support\ServiceProvider;

class BindFacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->bindServices();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }

    private function bindServices()
    {
        $this->app->bind('user-auth-service', function ($app) {
            return app(UserAuthService::class);
        });
        $this->app->bind('admin-auth-service', function ($app) {
            return app(AdminAuthService::class);
        });
        $this->app->bind('category-service', function ($app) {
            return app(CategoryService::class);
        });
        $this->app->bind('tag-service', function ($app) {
            return app(TagService::class);
        });
        $this->app->bind('article-service', function ($app) {
            return app(ArticleService::class);
        });
        $this->app->bind('admin-article-service', function ($app) {
            return app(AdminArticleService::class);
        });
        $this->app->bind('comment-service', function ($app) {
           return app(CommentService::class);
        });
    }
}
