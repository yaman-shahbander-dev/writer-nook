<?php

namespace Domain\Plan\Enums;

use Shared\Traits\EnumHelper;

enum PlanTypes: string
{
    use EnumHelper;

    case BASIC = 'basic';
    case PROFESSIONAL = 'professional';
    case PREMIUM = 'premium';
}
