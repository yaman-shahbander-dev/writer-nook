<?php

namespace App\Admin\v1\Http\Tag\Controllers;

use App\Admin\v1\Http\Tag\Requests\CreateTagRequest;
use App\Admin\v1\Http\Tag\Requests\UpdateTagRequest;
use App\Admin\v1\Http\Tag\Resources\TagResource;
use App\Http\Controllers\Controller;
use Domain\Tag\DataTransferObjects\TagData;
use Domain\Tag\Facades\TagFacade;
use Domain\Tag\Models\Tag;
use Illuminate\Http\JsonResponse;

class TagController extends Controller
{
    public function index(): JsonResponse
    {
        $this->authorize('view', new Tag());

        $tags = TagFacade::index();

        return TagResource::paginatedCollection($tags);
    }

    public function show(string $tag): JsonResponse
    {
        $this->authorize('view', new Tag());

        $tag = TagFacade::show($tag);

        return $tag
            ? $this->okResponse(TagResource::make($tag))
            : $this->notFoundResponse();
    }

    public function store(CreateTagRequest $request): JsonResponse
    {
        $this->authorize('create', Tag::class);

        $tag = TagFacade::store(TagData::from($request));

        return $tag
            ? $this->okResponse(TagResource::make($tag))
            : $this->failedResponse();
    }

    public function update(UpdateTagRequest $request, Tag $tag): JsonResponse
    {
        $result = TagFacade::update(TagData::from($request->all()));

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }

    public function destroy(Tag $tag): JsonResponse
    {
        $this->authorize('delete', $tag);

        $result = TagFacade::destroy($tag->id);

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }
}
