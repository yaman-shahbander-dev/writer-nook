<?php

namespace Domain\Article\Actions\User;

use App\Exceptions\Client\DataNotFoundException;
use Domain\Article\Models\Article;
use Domain\Like\DataTransferObjects\LikeData;
use Domain\Like\Models\Like;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class LikeOrUnlikeAction
{
    use AsAction;

    public function __construct(
        protected Like $like,
        protected Article $article
    ) {
    }

    public function handle(LikeData $data): bool|DataNotFoundException
    {
        $article = QueryBuilder::for($this->article)
            ->where('id', $data->likeableId)
            ->first();

        if (!$article) {
            throw new DataNotFoundException();
        }

        $liked = QueryBuilder::for($this->like)
            ->where([
                'user_id' => $data->userId,
                'likeable_type' => $data->likeableType,
                'likeable_id' => $data->likeableId
            ])
            ->whereNull('deleted_at')
            ->first();

        if (!$liked) {
            return !!QueryBuilder::for($this->like)
                ->create([
                    'user_id' => $data->userId,
                    'likeable_type' => $data->likeableType,
                    'likeable_id' => $data->likeableId
                ]);
        }

        return $liked->delete();
    }
}
