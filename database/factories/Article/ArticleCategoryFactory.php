<?php

namespace Database\Factories\Article;

use Database\Factories\Category\CategoryFactory;
use Domain\Article\Models\ArticleCategory;
use Illuminate\Database\Eloquent\Factories\Factory;


class ArticleCategoryFactory extends Factory
{
    protected $model = ArticleCategory::class;

    protected ArticleFactory $articleFactory;

    protected CategoryFactory $categoryFactory;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'article_id' => ($this->articleFactory ?? ArticleFactory::new()->create())->id,
            'category_id' => ($this->categoryFactory ?? CategoryFactory::new()->create())->id,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ];
    }
}
