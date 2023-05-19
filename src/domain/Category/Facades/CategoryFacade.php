<?php

namespace Domain\Category\Facades;

use Domain\Category\Services\CategoryService;
use Illuminate\Support\Facades\Facade;

class CategoryFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CategoryService::class;
    }
}
