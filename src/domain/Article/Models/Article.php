<?php

namespace Domain\Article\Models;

use Database\Factories\Article\ArticleFactory;
use Domain\Article\States\ArticleState;
use Domain\Category\Models\Category;
use Domain\Client\Models\User;
use Domain\Comment\Models\Comment;
use Domain\Like\Models\Like;
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
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia
{
    use HasFactory;
    use Uuid;
    use SoftDeletes;
    use HasStates;
    use InteractsWithMedia;

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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('article-image')
            ->useFallbackPath(public_path('/images/default-image.jpg'))
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif'])
            ->singleFile();
    }

    public function getImageAttribute(): string
    {
        return $this->getFirstMediaUrl('article-image');
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

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
