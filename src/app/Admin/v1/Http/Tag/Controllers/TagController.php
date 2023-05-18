<?php

namespace App\Admin\v1\Http\Tag\Controllers;

use App\Admin\v1\Http\Tag\Requests\CreateTagRequest;
use App\Admin\v1\Http\Tag\Requests\UpdateTagRequest;
use App\Admin\v1\Http\Tag\Resources\TagResource;
use App\Http\Controllers\Controller;
use Domain\Tag\Actions\CreateTagAction;
use Domain\Tag\Actions\DeleteTagAction;
use Domain\Tag\Actions\GetTagsAction;
use Domain\Tag\Actions\ShowTagAction;
use Domain\Tag\Actions\UpdateTagAction;
use Domain\Tag\DataTransferObjects\TagData;
use Domain\Tag\Models\Tag;
use Illuminate\Http\JsonResponse;

class TagController extends Controller
{
    public function index(): JsonResponse
    {
        $this->authorize('view', new Tag());

        $tags = GetTagsAction::run();

        return $tags
            ? $this->okResponse($tags)
            : $this->failedResponse();
    }

    public function show(string $tag): JsonResponse
    {
        $this->authorize('view', new Tag());

        $tag = ShowTagAction::run($tag);

        return $tag
            ? $this->okResponse(TagResource::make($tag))
            : $this->notFoundResponse();
    }

    public function store(CreateTagRequest $request): JsonResponse
    {
        $this->authorize('create', Tag::class);

        $tag = CreateTagAction::run(TagData::from($request->all()));

        return $tag
            ? $this->okResponse(TagResource::make($tag))
            : $this->failedResponse();
    }

    public function update(UpdateTagRequest $request, Tag $tag): JsonResponse
    {
        $this->authorize('update', $tag);

        $result = UpdateTagAction::run(TagData::from($request->all()));

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }

    public function destroy(Tag $tag): JsonResponse
    {
        $this->authorize('delete', $tag);

        $result = DeleteTagAction::run($tag->id);

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }
}
