<?php

namespace Domain\Tag\Facades;

use Domain\Tag\Services\TagService;
use Illuminate\Support\Facades\Facade;

class TagFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return TagService::class;
    }
}
