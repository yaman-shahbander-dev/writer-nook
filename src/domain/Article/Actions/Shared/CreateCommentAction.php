<?php

namespace Domain\Article\Actions\Shared;

use App\Exceptions\Client\DataNotFoundException;
use Domain\Article\Models\Article;
use Domain\Comment\DataTransferObjects\CommentData;
use Domain\Comment\Models\Comment;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class CreateCommentAction
{
    use AsAction;

    public function __construct(
        protected Comment $comment,
        protected Article $article
    ) {
    }

    public function handle(CommentData $data): bool|DataNotFoundException
    {
        $article = QueryBuilder::for($this->article)
            ->where('id', $data->commentableId)
            ->first();

        if (!$article) {
            throw new DataNotFoundException();
        }

        $comment = QueryBuilder::for($this->comment)
            ->create([
                'commentable_type' => $data->commentableType,
                'commentable_id' => $data->commentableId,
                'user_id' => $data->userId,
                'comment' => $data->comment,
            ]);

        return !!$comment;
    }
}
