<?php

namespace Domain\Client\Facades;

use Domain\Client\Services\AdminAuthService;
use Illuminate\Support\Facades\Facade;

class AdminAuthFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return AdminAuthService::class;
    }
}
