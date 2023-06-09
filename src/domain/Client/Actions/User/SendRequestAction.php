<?php

namespace Domain\Client\Actions\User;

use Domain\Client\DataTransferObjects\BecomeAuthorData;
use Domain\Client\Models\BecomeAuthor;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class SendRequestAction
{
    use AsAction;

    public function __construct(protected BecomeAuthor $becomeAuthor)
    {
    }

    public function handle(BecomeAuthorData $data): bool
    {
        $result = QueryBuilder::for($this->becomeAuthor)
            ->where('user_id', $data->user_id)
            ->first();

        if ($result) {
            return false;
        }

        return !!QueryBuilder::for($this->becomeAuthor)
            ->create([
                'title' => $data->title,
                'description' => $data->description,
                'approved' => 0,
                'user_id' => $data->user_id
            ]);
    }
}
