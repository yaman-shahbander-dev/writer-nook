<?php

namespace Domain\Plan\Facades;

use Domain\Plan\Services\AdminFeatureService;
use Illuminate\Support\Facades\Facade;

class AdminFeatureFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return AdminFeatureService::class;
    }
}
