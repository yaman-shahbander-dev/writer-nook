<?php

namespace Domain\Article\Models;

use Database\Factories\Article\ArticleCategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shared\Traits\Uuid;

class ArticleCategory extends Pivot
{
    use HasFactory;
    use Uuid;
    use SoftDeletes;

    protected $table = 'article_category';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'article_id',
        'category_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function newFactory(): ArticleCategoryFactory
    {
        return ArticleCategoryFactory::new();
    }
}
