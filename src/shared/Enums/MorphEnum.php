<?php

namespace Shared\Enums;

use Shared\Traits\EnumHelper;

enum MorphEnum: string
{
    use EnumHelper;
    case USER = 'user';
    case ARTICLE = 'article';
}
