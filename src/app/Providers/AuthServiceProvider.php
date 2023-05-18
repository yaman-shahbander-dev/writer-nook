<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Domain\Category\Models\Category;
use Domain\Category\Policies\CategoryPolicy;
use Domain\Tag\Models\Tag;
use Domain\Tag\Policies\TagPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Category::class => CategoryPolicy::class,
        Tag::class => TagPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
    }
}
