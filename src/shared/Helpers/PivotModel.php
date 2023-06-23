<?php

namespace Shared\Helpers;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Shared\Traits\Uuid;

class PivotModel extends Pivot
{
    use Uuid;
}
