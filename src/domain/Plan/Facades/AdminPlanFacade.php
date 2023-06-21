<?php

namespace Domain\Plan\Facades;

use Domain\Plan\Services\AdminPlanService;
use Illuminate\Support\Facades\Facade;

class AdminPlanFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return AdminPlanService::class;
    }
}
