<?php

namespace Domain\Comment\Facades;

use Domain\Comment\Services\CommentService;
use Illuminate\Support\Facades\Facade;

class CommentFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return CommentService::class;
    }
}
