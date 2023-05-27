<?php

namespace Domain\Article\Builders\Builders;

use Domain\Article\Builders\IBuilders\IArticleBuilder;
use Domain\Article\DataTransferObjects\ArticleData;
use Domain\Article\Models\Article;
use Domain\Article\States\Drafted;
use Domain\Category\DataTransferObjects\CategoryData;
use Domain\Tag\DataTransferObjects\TagData;
use Spatie\LaravelData\DataCollection;

class ArticleBuilder implements IArticleBuilder
{
    public function __construct(
        protected ArticleData $article,
        protected Article $articleModel,
    ) {
    }

    public function setUserId(string $userId): self
    {
        $this->article->userId = $userId;
        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->article->title = $title;
        return $this;
    }

    public function setContent(string $content): self
    {
        $this->article->content = $content;
        return $this;
    }

    public function setHashedContent(string $hashedContent): self
    {
        $this->article->hashedContent = $hashedContent;
        return $this;
    }

    public function setExcerpt(string $excerpt): self
    {
        $this->article->excerpt = $excerpt;
        return $this;
    }

    public function setState(): self
    {
        $this->article->state = Drafted::getMorphClass();
        return $this;
    }

    public function setCategories(array $categories): self
    {
        $this->article->categories = new DataCollection(CategoryData::class, $categories);
        return $this;
    }

    public function setTags(array $tags): self
    {
        $this->article->tags = new DataCollection(TagData::class, $tags);
        return $this;
    }

    public function build(): ArticleData
    {
        return $this->article;
    }
}
