<?php

namespace Domain\Article\Models;

use Database\Factories\Article\ArticleFactory;
use Domain\Article\States\ArticleState;
use Domain\Category\Models\Category;
use Domain\Client\Models\User;
use Domain\Comment\Models\Comment;
use Domain\Tag\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shared\Traits\Uuid;
use Spatie\ModelStates\HasStates;

class Article extends Model
{
    use HasFactory;
    use Uuid;
    use SoftDeletes;
    use HasStates;

    protected $table = 'articles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'title',
        'content',
        'hashed_content',
        'excerpt',
        'state',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
      'state' => ArticleState::class
    ];

    protected static function newFactory(): ArticleFactory
    {
        return ArticleFactory::new();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)
            ->using(new class extends Pivot {
                use Uuid;
            });
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)
            ->using(new class extends Pivot {
                use Uuid;
            });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
