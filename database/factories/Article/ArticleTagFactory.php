<?php

namespace Database\Factories\Article;

use Database\Factories\Tag\TagFactory;
use Domain\Article\Models\ArticleCategory;
use Illuminate\Database\Eloquent\Factories\Factory;


class ArticleTagFactory extends Factory
{
    protected $model = ArticleCategory::class;

    protected ArticleFactory $articleFactory;

    protected TagFactory $tagFactory;

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
            'tag_id' => ($this->tagFactory ?? TagFactory::new()->create())->id,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ];
    }
}
