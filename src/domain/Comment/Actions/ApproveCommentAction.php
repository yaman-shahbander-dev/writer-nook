<?php

namespace Domain\Comment\Actions;

use Domain\Comment\Models\Comment;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class ApproveCommentAction
{
    use AsAction;

    public function __construct(
        protected Comment $comment
    ) {
    }

    public function handle(string $id): bool
    {
        return QueryBuilder::for($this->comment)
            ->where('id', $id)
            ->update([
                'approved' => 1
            ]);
    }
}
