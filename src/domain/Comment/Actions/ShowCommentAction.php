<?php

namespace Domain\Comment\Actions;

use Domain\Comment\DataTransferObjects\CommentData;
use Domain\Comment\Models\Comment;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ShowCommentAction
{
    use AsAction;

    public function __construct(
        protected Comment $comment
    ) {
    }

    public function handle(string $id): CommentData|NotFoundHttpException
    {
        $comment = QueryBuilder::for($this->comment)
            ->where('id', $id)
            ->first();

        if (!$comment) {
            throw new NotFoundHttpException();
        }

        $comment->load('user');

        return CommentData::from($comment);
    }
}
