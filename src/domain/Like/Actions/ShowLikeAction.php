<?php

namespace Domain\Like\Actions;

use Domain\Like\DataTransferObjects\LikeData;
use Domain\Like\Models\Like;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ShowLikeAction
{
    use AsAction;

    public function __construct(
        protected Like $like
    ) {
    }

    public function handle(string $id): NotFoundHttpException|LikeData
    {
        $like = QueryBuilder::for($this->like)
            ->where('id', $id)
            ->allowedIncludes('user')
            ->first();

        if (!$like) {
            return throw new NotFoundHttpException();
        }

        return LikeData::from($like);
    }
}
