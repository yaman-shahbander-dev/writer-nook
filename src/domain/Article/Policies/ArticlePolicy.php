<?php

namespace Domain\Article\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Domain\Client\Enums\PermissionEnum;
use Domain\Client\Models\User;
use Domain\Article\Models\Article;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function view(User $user, Article $article): bool
    {
        return $user->can(PermissionEnum::ARTICLE_VIEW->value);
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionEnum::ARTICLE_CREATE->value);
    }

    public function update(User $user, Article $article): bool
    {
        return ($user->can(PermissionEnum::ARTICLE_UPDATE->value) && $article->user_id === $user->id);
    }

    public function approve(User $user, Article $article): bool
    {
        return $user->can(PermissionEnum::ARTICLE_APPROVE->value);
    }

    public function delete(User $user, Article $article): bool
    {
        return ($user->can(PermissionEnum::ARTICLE_DELETE->value) || $article->user_id === $user->id);
    }
}
