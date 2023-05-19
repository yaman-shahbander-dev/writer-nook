<?php

namespace Domain\Client\Facades;

use Domain\Client\Services\UserAuthService;
use Illuminate\Support\Facades\Facade;

class UserAuthFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return UserAuthService::class;
    }
}
