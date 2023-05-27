<?php

namespace Domain\Article\Builders\IBuilders;

use Domain\Article\DataTransferObjects\ArticleData;

interface IArticleBuilder
{
    public function setUserId(string $userId): self;
    public function setTitle(string $title): self;
    public function setContent(string $content): self;
    public function setHashedContent(string $hashedContent): self;
    public function setExcerpt(string $excerpt): self;
    public function setCategories(array $categories): self;
    public function setTags(array $tags): self;
    public function setState(): self;
    public function build(): ArticleData;
}
