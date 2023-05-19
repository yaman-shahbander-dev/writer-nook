<?php

namespace Domain\Category\Services;

use Domain\Category\Actions\CreateCategoryAction;
use Domain\Category\Actions\DeleteCategoryAction;
use Domain\Category\Actions\GetCategoriesAction;
use Domain\Category\Actions\ShowCategoryAction;
use Domain\Category\Actions\UpdateCategoryAction;
use Domain\Category\DataTransferObjects\CategoryData;

class CategoryService
{
    public function index() {
        return GetCategoriesAction::run();
    }

    public function show(string $category) {
        return ShowCategoryAction::run($category);
    }

    public function store(CategoryData $data) {
        return CreateCategoryAction::run($data);
    }

    public function update(CategoryData $data) {
        return UpdateCategoryAction::run($data);
    }

    public function destroy(string $category) {
        return DeleteCategoryAction::run($category);
    }
}
