<?php

namespace Domain\Client\Enums;

use Shared\Traits\EnumHelper;

enum RoleEnum: string
{
    use EnumHelper;
    case ADMIN = 'admin';
    case AUTHOR = 'author';
    case USER = 'user';

    public static function getRolesPermissions(): array
    {
        return [
            self::ADMIN->value => [
                PermissionEnum::USER_VIEW_ANY->value,
                PermissionEnum::USER_CREATE->value,
                PermissionEnum::USER_UPDATE->value,
                PermissionEnum::USER_DELETE->value,
                PermissionEnum::CATEGORY_VIEW_ANY->value,
                PermissionEnum::CATEGORY_CREATE->value,
                PermissionEnum::CATEGORY_UPDATE->value,
                PermissionEnum::CATEGORY_DELETE->value,
                PermissionEnum::TAG_VIEW_ANY->value,
                PermissionEnum::TAG_CREATE->value,
                PermissionEnum::TAG_UPDATE->value,
                PermissionEnum::TAG_DELETE->value,
                PermissionEnum::ARTICLE_VIEW->value,
                PermissionEnum::ARTICLE_APPROVE->value,
                PermissionEnum::ARTICLE_DELETE->value,
                PermissionEnum::COMMENT_VIEW->value,
                PermissionEnum::COMMENT_CREATE->value,
                PermissionEnum::COMMENT_DELETE->value,
                PermissionEnum::COMMENT_APPROVE->value,
                PermissionEnum::LIKE_VIEW->value,
                PermissionEnum::LIKE_CREATE->value,
                PermissionEnum::BECOME_AUTHOR_VIEW->value,
                PermissionEnum::BECOME_AUTHOR_DELETE->value,
                PermissionEnum::BECOME_AUTHOR_APPROVE->value,
                PermissionEnum::PLAN_VIEW->value,
                PermissionEnum::PLAN_CREATE->value,
                PermissionEnum::PLAN_UPDATE->value,
                PermissionEnum::PLAN_DELETE->value,
                PermissionEnum::PLAN_CANCEL->value,
                PermissionEnum::PLAN_RESUME->value,
                PermissionEnum::FEATURE_VIEW->value,
                PermissionEnum::FEATURE_CREATE->value,
                PermissionEnum::FEATURE_UPDATE->value,
                PermissionEnum::FEATURE_DELETE->value,
            ],
            self::AUTHOR->value => [
                PermissionEnum::ARTICLE_VIEW->value,
                PermissionEnum::ARTICLE_CREATE->value,
                PermissionEnum::ARTICLE_UPDATE->value,
                PermissionEnum::ARTICLE_DELETE->value,
                PermissionEnum::COMMENT_CREATE->value,
                PermissionEnum::LIKE_VIEW->value,
                PermissionEnum::PLAN_VIEW->value,
                PermissionEnum::PLAN_CANCEL->value,
                PermissionEnum::PLAN_RESUME->value,
                PermissionEnum::PLAN_CHECKOUT->value,
                PermissionEnum::PLAN_SUBSCRIBE->value,
            ],
            self::USER->value => [
                PermissionEnum::ARTICLE_VIEW->value,
                PermissionEnum::COMMENT_CREATE->value,
                PermissionEnum::LIKE_VIEW->value,
                PermissionEnum::BECOME_AUTHOR_SEND->value,
                PermissionEnum::PLAN_VIEW->value,
                PermissionEnum::PLAN_CANCEL->value,
                PermissionEnum::PLAN_RESUME->value,
                PermissionEnum::PLAN_CHECKOUT->value,
                PermissionEnum::PLAN_SUBSCRIBE->value,
            ]
        ];
    }
}
