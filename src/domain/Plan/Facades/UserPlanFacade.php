<?php

namespace Domain\Plan\Facades;

use Domain\Plan\Services\UserPlanService;
use Illuminate\Support\Facades\Facade;

class UserPlanFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return UserPlanService::class;
    }
}
