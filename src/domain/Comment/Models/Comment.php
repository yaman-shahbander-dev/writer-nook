<?php

namespace Domain\Comment\Models;

use Database\Factories\Comment\CommentFactory;
use Domain\Client\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shared\Traits\Uuid;
use Spatie\ModelStates\HasStates;

class Comment extends Model
{
    use HasFactory;
    use Uuid;
    use SoftDeletes;
    use HasStates;

    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'commentable_type',
        'commentable_id',
        'user_id',
        'comment',
        'approved',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function newFactory(): CommentFactory
    {
        return CommentFactory::new();
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
