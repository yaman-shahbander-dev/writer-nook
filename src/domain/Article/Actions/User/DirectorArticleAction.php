<?php

namespace Domain\Article\Actions\User;

use Domain\Article\Builders\Directors\ArticleDirector;
use Domain\Article\Builders\IBuilders\IArticleBuilder;
use Domain\Article\DataTransferObjects\ArticleData;
use Domain\Article\Models\Article;
use Domain\Category\DataTransferObjects\CategoryData;
use Domain\Client\DataTransferObjects\UserData;
use Domain\Tag\DataTransferObjects\TagData;
use Lorisleiva\Actions\Concerns\AsAction;

class DirectorArticleAction
{
    use AsAction;

    public function __construct(
        protected Article $article,
        protected IArticleBuilder $builder,
        protected ArticleDirector $director
    ) {
    }

    public function handle(array $data): ArticleData
    {
        $article = $this->director->createArticle(
            $data['title'],
            $data['content'],
            $data['hashed_content'],
            $data['excerpt'],
            $data['categories'],
            $data['tags'],
            $data['user_id'],
        );

        $articleDB = CreateArticleAction::run($article);

        $articleDB->load('author');

        $categories = SyncCategoriesToArticleAction::run($articleDB, getIds($article->categories));

        $tags = SyncTagsToArticleAction::run($articleDB, getIds($article->tags));

        return ArticleData::from([
            'id' => $articleDB->id,
            'user_id' => $articleDB->user_id,
            'title' => $articleDB->title,
            'content' => $articleDB->content,
            'hashed_content' => $articleDB->hashed_content,
            'excerpt' => $articleDB->excerpt,
            'created_at' => $articleDB->created_at,
            'updated_at' => $articleDB->updated_at,
            'deleted_at' => $articleDB->deleted_at,
            'author' => UserData::from($articleDB->author),
            'categories' => CategoryData::collection($categories),
            'tags' => TagData::collection($tags),
        ]);
    }
}
