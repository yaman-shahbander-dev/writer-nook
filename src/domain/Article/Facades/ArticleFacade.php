<?php

namespace Domain\Article\Facades;

use Domain\Article\Services\ArticleService;
use Illuminate\Support\Facades\Facade;

class ArticleFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ArticleService::class;
    }
}
