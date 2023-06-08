<?php

namespace App\Admin\v1\Http\Like\Controllers;

use App\Admin\v1\Http\Like\Resources\LikeResource;
use App\Http\Controllers\Controller;
use Domain\Like\Actions\GetLikesAction;
use Domain\Like\Actions\ShowLikeAction;
use Domain\Like\Models\Like;
use Illuminate\Http\JsonResponse;

class LikeController extends  Controller
{
    public function index(): JsonResponse
    {
        $this->authorize('view', app(Like::class));

        $likes = GetLikesAction::run();

        return LikeResource::paginatedCollection($likes);
    }

    public function show(Like $like): JsonResponse
    {
        $this->authorize('view', app(Like::class));

        $like = ShowLikeAction::run($like->id);

        return $like
            ? $this->okResponse(LikeResource::make($like))
            : $this->notFoundResponse();
    }
}
