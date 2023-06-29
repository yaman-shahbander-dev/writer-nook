<p align="center">
  A <a href="https://laravel.com" target="_blank">Laravel</a> project with a Domain-Driven Design (DDD) structure.
</p>
<p style="color: lavender">
<b>Writer Nook</b> is a dynamic web application that offers a rich and diverse collection of articles on a variety of topics.
It is designed to provide users with the focus on reading experience, where they can engage with content, 
leave comments and express their appreciation by liking their favorite articles.
</p>
<p style="color: lavender">
To access the full range of our content, users must subscribe to one of the premium plans defined by the admin.
</p>
<p style="color: lavender">
The application has three types of users: regular users, authors, and admins. Authors have the unique privilege of creating 
and publishing their own articles, while still enjoying the same features and benefits as regular users.
</p>

# Requirements
- PHP ^8.1
- Composer ^2.2

# Installation
```bash
composer create-project yaman-shahbander/writer-nook api-app
```
Install dependencies
```bash
cd api-app
composer install
```
Setup .env file
```bash
cp .env.example .env
```
Generate the application key
```bash
php artisan key:generate 
```
Run Locally
```bash
php artisan serve
```

# Credentials
To login as an admin use these credentials:
```bash
email: admin@project.com
password: password
```

To login as an author use these credentials:
```bash
email: author@project.com
password: password
```

To login as a user use these credentials:
```bash
email: user@project.com
password: password
```


# Installed Packages

General:
- [Passport](https://laravel.com/docs/10.x/passport)
- [Laravel Actions](https://laravelactions.com)
- [Laravel Data](https://spatie.be/docs/laravel-data/v3/introduction)
- [Laravel Query Builder](https://spatie.be/index.php/docs/laravel-query-builder/v5/introduction)
- [Laravel Cashier](https://laravel.com/docs/10.x/billing)
- [Laravel Passport](https://laravel.com/docs/10.x/passport)
- [Spatie Media Library](https://spatie.be/docs/laravel-medialibrary/v10/introduction)
- [Laravel Model States](https://spatie.be/docs/laravel-model-states/v2/01-introduction)
- [Laravel Permission](https://spatie.be/docs/laravel-permission/v5/introduction)
- [Stripe PHP](https://github.com/stripe/stripe-php)

Development:
- [Laravel IDE Helper](https://github.com/barryvdh/laravel-ide-helper)
- [Scribe API documentation tool](https://scribe.knuckles.wtf/laravel)
- [Laravel Telescope](https://laravel.com/docs/10.x/telescope)
- [Pest Testing Framework](https://pestphp.com/)
- [Grum PHP](https://github.com/phpro/grumphp)
- [Security Advisor](https://github.com/Roave/SecurityAdvisories)
- [Laravel Homestead](https://laravel.com/docs/10.x/homestead)

# Features
- [DDD (Domain Driven Design)](#ddd)
- [API Response Helper](#api-response-helper)
- [Global Helper](#global-helper)
- [Migration Structure](#migration-structure)
- [Polymorphic Mapping](#polymorphic-mapping)
- [Database Seeders](#database-seeders)
- [Shared Directory](#shared-directory)
- [Enable Model Strict Mode](https://laravel.com/docs/10.x/eloquent#configuring-eloquent-strictness)
- [Pest testing framework](https://pestphp.com/docs/installation)

## DDD
Software development approach that tries to bring the business language and the source code as close as possible.

This structure is inspired by [LARAVEL BEYOND CRUD](https://laravel-beyond-crud.com/).

### Files Structure
Domain Layer Example:

    src/Domain/Invoices/
    ├── Actions
    ├── QueryBuilders
    ├── Collections
    ├── Data
    ├── Events
    ├── Exceptions
    ├── Listeners
    ├── Models
    ├── Rules
    └── States
    src/Domain/Products/
    ├── Actions
    └── .....

Application Layer Example:

    The REST API application:
    src/App/Api/
    ├── Products
        ├── Controllers
        ├── Middlewares
        ├── Requests
        ├── Queries
        ├── Filters
        └── Resources

    The Console application
    src/App/Console/
    └── Commands

    The admin HTTP application:
    src/App/Admin/
    ├── Products
        ├── Controllers
        ├── Middlewares
        ├── Requests
        ├── Resources
        ├── Queries
        ├── Filters
        └── ViewModels

### Resources
- [Domain Oriented Laravel](https://stitcher.io/blog/laravel-beyond-crud-01-domain-oriented-laravel)
- [Working With Data](https://stitcher.io/blog/laravel-beyond-crud-02-working-with-data)
- [Actions](https://stitcher.io/blog/laravel-beyond-crud-03-actions)
- [Models](https://stitcher.io/blog/laravel-beyond-crud-04-models)
- [States](https://stitcher.io/blog/laravel-beyond-crud-05-states)
- [Managing Domains](https://stitcher.io/blog/laravel-beyond-crud-06-managing-domains)
- [Application Layer](https://stitcher.io/blog/laravel-beyond-crud-07-entering-the-application-layer)
- [View Models](https://stitcher.io/blog/laravel-beyond-crud-08-view-models)
- [Test Factories](https://stitcher.io/blog/laravel-beyond-crud-09-test-factories)

## API Response Helper
A simple trait allowing consistent API responses throughout your Laravel application.

### Available methods:
| Method                    | Status |
|:--------------------------|:-------|
| `okResponse()`            | `200`  |
| `createdResponse()`       | `201`  |
| `failedResponse()`        | `400`  |
| `unauthorizedResponse()`  | `401`  |
| `forbiddenResponse()`     | `403`  |
| `notFoundResponse()`      | `404`  |
| `unprocessableResponse()` | `422`  |
| `serverErrorResponse()`   | `500`  |

### Usages Example:
```php
<?php

namespace App\Http\Api\Controllers;

use App\Traits\ApiResponseHelpers;
use Illuminate\Http\JsonResponse;
use App\Http\Controller;

class ProductController extends Controller
{
    use ApiResponseHelper;

    public function index(): JsonResponse
    {
        return $this->okResponse();
    }
}
```

## Global Helper
Simple php file that contains you global functions, which you can find it in `./src/shared/Helpers/global.php`.

## Migration Structure
In order to group your migration files by their domains, you can create additional migration directories
and load them in the `AppServiceProvider` using `loadMigrationsFrom` function:

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom([
            database_path().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR.'Client',
        ]);
    }
}
```

## Polymorphic Mapping
Please read this [article](https://laravel-news.com/enforcing-morph-maps-in-laravel) first to identify the problem.

In order to achieve the morph mapping, we created the `MorphEnum` that will contain each model morph key and then use it
in `Relation::morphMap` function as shown in the example:
```php
<?php

namespace Shared\Enums;

enum MorphEnum: string
{
    case USER = 'user';
}
```

```php
<?php

namespace App\Providers;

use Shared\Enums\MorphEnum;
use Domain\Client\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Relation::morphMap([
            MorphEnum::USER->value => User::class,
        ]);
    }
}
```

## Database Seeders
We generally have two types of seeded data:

- Initial data: the project cannot function without it. For example, countries table data, and these data usually come
  from datasets.
- Fake data: for testing purposes that can fill up any table instead of manually inserting row by row, this data is
  usually generated by factories.

In order to prevent the fake data from being seeded in the production environment, we created a new seeder class
called `TestingSeeder.php` which will contain all the fake data seeders and will only run in a non-production
environment. The normal seeders will stay in `DatabaseSeeder.php`.

## Shared Directory
The `src/shared/` directory is used for helper, traits, enums .... that are going to be used by the application and the domain.
