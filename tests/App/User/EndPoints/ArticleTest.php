<?php

use Illuminate\Http\Response;
use Database\Factories\Article\ArticleFactory;
use Database\Factories\Client\UserFactory;
use Database\Factories\Category\CategoryFactory;
use Database\Factories\Tag\TagFactory;
use Domain\Client\Enums\PermissionEnum;
use Shared\Enums\MorphEnum;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Artisan::call('passport:install');
    $this->author = UserFactory::new()->author()->create();
    $this->user = UserFactory::new()->create();
    $this->categories = CategoryFactory::new()->count(10)->create();
    $this->tags = TagFactory::new()->count(10)->create();
    $this->articles = ArticleFactory::new(['user_id' => $this->author->id])->count(10)->create();
    $this->createArticle = ArticleFactory::new()->definition();
    $this->createArticle['categories'][]['id'] = $this->categories->first()->id;
    $this->createArticle['tags'][]['id'] = $this->tags->first()->id;
    $this->authorComment = [
        'commentable_type' => MorphEnum::ARTICLE->value,
        'article_id' => $this->articles->first()->id,
        'user_id' => $this->author->id,
        'comment' => 'new comment'
    ];
    $this->userComment = [
        'commentable_type' => MorphEnum::ARTICLE->value,
        'article_id' => $this->articles->first()->id,
        'user_id' => $this->user->id,
        'comment' => 'new comment'
    ];
});

it('gets paginated articles for the author', function () {
    actWithPermission($this->author, PermissionEnum::ARTICLE_VIEW->value, ['author']);
    $this->get(route('user.article.index'))->assertStatus(Response::HTTP_OK);
});

it('gets paginated articles for the user', function () {
    actWithPermission($this->user, PermissionEnum::ARTICLE_VIEW->value);
    $this->get(route('user.article.index'))->assertStatus(Response::HTTP_OK);
});

it('gets an article for the author', function () {
    actWithPermission($this->author, PermissionEnum::ARTICLE_VIEW->value, ['author']);
    $this->get(route('user.article.show', ['article' => $this->articles->first()->id]))
        ->assertStatus(Response::HTTP_OK);
});

it('gets an article for the user', function () {
    actWithPermission($this->user, PermissionEnum::ARTICLE_VIEW->value);
    $this->get(route('user.article.show', ['article' => $this->articles->first()->id]))
        ->assertStatus(Response::HTTP_OK);
});

//it('creates an article for the author', function () {
//    actWithPermission($this->author, PermissionEnum::ARTICLE_CREATE->value, ['author']);
//    Storage::fake('local');
//    $image = UploadedFile::fake()
//        ->create('test.png', 100, 'image/png')
//        ->mimeType('image/png');
//    $this->createArticle['image'] = $image;
//    $this->post(route('user.article.store', $this->createArticle))
//        ->assertStatus(Response::HTTP_OK);
//});

it('deletes an article for the author', function () {
    actWithPermission($this->author, PermissionEnum::ARTICLE_DELETE->value, ['author']);
    $this->delete(route('user.article.destroy', ['article' => $this->articles->first()->id]))
        ->assertStatus(Response::HTTP_OK);
});

it('makes an article ready for the author', function () {
    actWithPermission($this->author, PermissionEnum::ARTICLE_UPDATE->value, ['author']);
    $this->put(
        route(
            'user.article.ready',
            ['article' => $this->articles->first()->id]
        )
    )->assertStatus(Response::HTTP_OK);
});

it('stores an article for the author', function () {
    actWithPermission($this->author, PermissionEnum::COMMENT_CREATE->value, ['author']);
    $this->post(route('user.article.comment.create'), $this->authorComment)
        ->assertStatus(Response::HTTP_OK);
});

it('stores an article for the user', function () {
    actWithPermission($this->user, PermissionEnum::COMMENT_CREATE->value);
    $this->post(route('user.article.comment.create'), $this->userComment)
        ->assertStatus(Response::HTTP_OK);
});

it('likes or unlikes an article for the user', function () {
    actWithPermission($this->user, PermissionEnum::LIKE_CREATE->value);
    $this->post(route('user.article.like.unlike'), ['article_id' => $this->articles->first()->id])
        ->assertStatus(Response::HTTP_OK);
});
