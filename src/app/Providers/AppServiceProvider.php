<?php

namespace App\Providers;

use Domain\Article\Builders\Builders\ArticleBuilder;
use Domain\Article\Builders\IBuilders\IArticleBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Shared\Enums\MorphEnum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IArticleBuilder::class, ArticleBuilder::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Model::shouldBeStrict(! $this->app->isProduction());

        Relation::morphMap([
            MorphEnum::USER->value => \Domain\Client\Models\User::class,
        ]);

        $this->loadMigrationsFrom([
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'Client',
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'Category',
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'Tag',
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'Article',
        ]);


        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        Passport::tokensCan([
            'admin' => 'Admin can access the dashboard',
            'user' => 'user can access the web app',
            'author' => 'author can access the web app as well as creating articles'
        ]);

        Passport::setDefaultScope('user');
    }
}
