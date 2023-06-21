<?php

namespace Domain\Plan\Actions\Shared;

use Domain\Client\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class ResumeSubscriptionAction
{
    use AsAction;

    public function __construct(
    ) {
    }

    public function handle(string $name, User $user): bool
    {
        return !!$user->subscription($name)->resume();
    }
}
