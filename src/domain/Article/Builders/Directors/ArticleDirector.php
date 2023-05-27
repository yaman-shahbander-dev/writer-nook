<?php

namespace Domain\Article\Builders\Directors;

use Domain\Article\Builders\IBuilders\IArticleBuilder;
use Domain\Article\DataTransferObjects\ArticleData;

class ArticleDirector
{
    public function __construct(protected IArticleBuilder $builder) {
    }

    public function createArticle($title, $content, $hashedContent, $excerpt, $categories, $tags, $userId): ArticleData
    {
        return $this->builder
            ->setUserId($userId)
            ->setTitle($title)
            ->setContent($content)
            ->setHashedContent($hashedContent)
            ->setExcerpt($excerpt)
            ->setState()
            ->setCategories($categories)
            ->setTags($tags)
            ->build();
    }
}
