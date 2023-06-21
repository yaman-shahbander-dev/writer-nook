<?php

namespace Domain\Plan\Models;

use Domain\Client\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Cashier\Subscription as CashierSubscription;

class Subscription extends CashierSubscription
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
