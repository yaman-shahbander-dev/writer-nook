<?php

namespace Domain\Plan\Actions\User;

use App\Exceptions\Client\DataNotFoundException;
use Domain\Client\Models\User;
use Domain\Plan\Models\Plan;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class CheckoutAction
{
    use AsAction;

    public function __construct(
        protected Plan $plan
    ) {
    }

    public function handle(string $id, User $user): array|DataNotFoundException
    {
        $plan = QueryBuilder::for($this->plan)
            ->where('id', $id)
            ->first();

        if (!$plan) {
            return throw new DataNotFoundException();
        }

        return [
          'plan' => $plan,
          'intent' => $user->createSetupIntent()
        ];
    }
}
