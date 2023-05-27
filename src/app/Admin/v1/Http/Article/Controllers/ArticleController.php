<?php

namespace App\Admin\v1\Http\Article\Controllers;

use App\Admin\v1\Http\Article\Resources\ArticleResource;
use App\Http\Controllers\Controller;
use Domain\Article\Facades\AdminArticleFacade;
use Domain\Article\Models\Article;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    public function index(): JsonResponse
    {
        $this->authorize('view', new Article());

        $articles = AdminArticleFacade::index();

        return ArticleResource::paginatedCollection($articles);
    }

    public function show(string $article): JsonResponse
    {
        $this->authorize('view', new Article());

        $article = AdminArticleFacade::show($article);

        return $article
            ? $this->okResponse(ArticleResource::make($article))
            : $this->failedResponse();
    }

    public function approve(string $article): JsonResponse
    {
        $this->authorize('approve', new Article());

        $result = AdminArticleFacade::approve($article);

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }

    public function destroy(Article $article): JsonResponse
    {
        $this->authorize('delete', $article);

        $result = AdminArticleFacade::destroy($article->id);

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }
}
