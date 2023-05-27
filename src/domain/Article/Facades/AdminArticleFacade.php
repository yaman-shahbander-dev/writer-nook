<?php

namespace Domain\Article\Facades;

use Domain\Article\Services\AdminArticleService;
use Illuminate\Support\Facades\Facade;

class AdminArticleFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return AdminArticleService::class;
    }
}
