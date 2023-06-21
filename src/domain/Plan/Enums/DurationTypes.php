<?php

namespace Domain\Plan\Enums;

use Shared\Traits\EnumHelper;

enum DurationTypes: string
{
    use EnumHelper;

    case DAY = 'day';
    case MONTH = 'month';
    case YEAR = 'year';
}
