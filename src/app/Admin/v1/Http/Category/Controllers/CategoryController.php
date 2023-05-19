<?php

namespace App\Admin\v1\Http\Category\Controllers;

use App\Admin\v1\Http\Category\Requests\CreateCategoryRequest;
use App\Admin\v1\Http\Category\Requests\UpdateCategoryRequest;
use App\Admin\v1\Http\Category\Resources\CategoryResource;
use App\Http\Controllers\Controller;
use Domain\Category\DataTransferObjects\CategoryData;
use Domain\Category\Models\Category;
use Illuminate\Http\JsonResponse;
use Domain\Category\Facades\CategoryFacade;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $this->authorize('view', new Category());

        $categories = CategoryFacade::index();

        return $categories
            ? $this->okResponse($categories)
            : $this->failedResponse();
    }

    public function show(string $category): JsonResponse
    {
        $this->authorize('view', new Category());

        $category = CategoryFacade::show($category);

        return $category
            ? $this->okResponse(CategoryResource::make($category))
            : $this->notFoundResponse();
    }

    public function store(CreateCategoryRequest $request): JsonResponse
    {
        $this->authorize('create', Category::class);

        $category = CategoryFacade::store(CategoryData::from($request->all()));

        return $category
            ? $this->okResponse(CategoryResource::make($category))
            : $this->failedResponse();
    }

    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $this->authorize('update', $category);

        $result = CategoryFacade::update(CategoryData::from($request));

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }

    public function destroy(Category $category): JsonResponse
    {
        $this->authorize('delete', $category);

        $result = CategoryFacade::destroy($category->id);

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }
}
