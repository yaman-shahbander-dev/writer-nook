<?php

namespace App\Providers;

use Domain\Article\Builders\Builders\ArticleBuilder;
use Domain\Article\Builders\IBuilders\IArticleBuilder;
use Domain\Article\Models\Article;
use Domain\Client\Models\User;
use Domain\Plan\Actions\Admin\CreateStripePlanAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Shared\Enums\MorphEnum;
use Stripe\StripeClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IArticleBuilder::class, ArticleBuilder::class);
        $this->app->bind(
            CreateStripePlanAction::class,
            fn() => new CreateStripePlanAction(new StripeClient(config('payment.stripe.secret_key')))
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Model::shouldBeStrict(! $this->app->isProduction());

        Relation::morphMap([
            MorphEnum::USER->value => User::class,
            MorphEnum::ARTICLE->value => Article::class
        ]);

        $this->loadMigrationsFrom([
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'Client',
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'Category',
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'Tag',
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'Article',
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'Comment',
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'Like',
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'Plan',
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
