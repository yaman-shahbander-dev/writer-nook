<?php

namespace Domain\Article\Enums;

use Shared\Traits\EnumHelper;

enum ArticleStates: string
{
    use EnumHelper;

    case DRAFTED = 'drafted';
    case READY = 'ready';
    case PUBLISHED = 'published';
    case DELETED = 'deleted';
}
