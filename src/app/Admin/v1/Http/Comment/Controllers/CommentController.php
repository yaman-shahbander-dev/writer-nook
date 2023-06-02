<?php

namespace App\Admin\v1\Http\Comment\Controllers;

use App\Admin\v1\Http\Comment\Resources\CommentResource;
use App\Http\Controllers\Controller;
use Domain\Comment\Facades\CommentFacade;
use Domain\Comment\Models\Comment;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    public function index(): JsonResponse
    {
        $this->authorize('view', app(Comment::class));

        $comments = CommentFacade::index();

        return CommentResource::paginatedCollection($comments);
    }

    public function show(Comment $comment): JsonResponse
    {
        $this->authorize('view', app(Comment::class));

        $comment = CommentFacade::show($comment->id);

        return $comment
            ? $this->okResponse(CommentResource::make($comment))
            : $this->notFoundResponse();
    }

    public function approve(Comment $comment): JsonResponse
    {
        $this->authorize('update', $comment);

        $comment = CommentFacade::approve($comment->id);

        return $comment
            ? $this->okResponse()
            : $this->failedResponse();
    }

    public function destroy(Comment $comment): JsonResponse
    {
        $this->authorize('delete', $comment);

        $comment = CommentFacade::destroy($comment->id);

        return $comment
            ? $this->okResponse()
            : $this->failedResponse();
    }
}
