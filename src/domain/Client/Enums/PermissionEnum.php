<?php

namespace Domain\Client\Enums;

use Shared\Traits\EnumHelper;

enum PermissionEnum: string
{
    use EnumHelper;

    case USER_VIEW_ANY = 'user.view.*';
    case USER_CREATE = 'user.create.*';
    case USER_UPDATE = 'user.update.*';
    case USER_DELETE = 'user.delete.*';

    case CATEGORY_VIEW_ANY = 'category.view.*';
    case CATEGORY_CREATE = 'category.create.*';
    case CATEGORY_UPDATE = 'category.update.*';
    case CATEGORY_DELETE = 'category.delete.*';

    case TAG_VIEW_ANY = 'tag.view.*';
    case TAG_CREATE = 'tag.create.*';
    case TAG_UPDATE = 'tag.update.*';
    case TAG_DELETE = 'tag.delete.*';

    case ARTICLE_VIEW = 'article.view.*';
    case ARTICLE_CREATE = 'article.create.*';
    case ARTICLE_UPDATE = 'article.update.*';
    case ARTICLE_DELETE = 'article.delete.*';
    case ARTICLE_APPROVE = 'article.approve.*';

    case COMMENT_VIEW = 'comment.view.*';
    case COMMENT_CREATE = 'comment.create.*';
    case COMMENT_DELETE = 'comment.delete.*';
    case COMMENT_APPROVE = 'comment.approve.*';

    case LIKE_VIEW = 'like.view.*';
    case LIKE_CREATE = 'like.create.*';

    case BECOME_AUTHOR_VIEW = 'become_author.view.*';
    case BECOME_AUTHOR_DELETE = 'become_author.delete.*';
    case BECOME_AUTHOR_APPROVE = 'become_author.approve.*';
    case BECOME_AUTHOR_SEND = 'become_author.send.*';

    case PLAN_VIEW = 'plan.view.*';
    case PLAN_CREATE = 'plan.create.*';
    case PLAN_UPDATE = 'plan.update.*';
    case PLAN_DELETE = 'plan.delete.*';
    case PLAN_CANCEL = 'plan.cancel.*';
    case PLAN_RESUME = 'plan.resume.*';
    case PLAN_CHECKOUT = 'plan.checkout.*';
    case PLAN_SUBSCRIBE = 'plan.subscribe.*';

    case FEATURE_VIEW = 'feature.view.*';
    case FEATURE_CREATE = 'feature.create.*';
    case FEATURE_UPDATE = 'feature.update.*';
    case FEATURE_DELETE = 'feature.delete.*';
}
