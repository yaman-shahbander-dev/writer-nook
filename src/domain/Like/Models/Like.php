<?php

namespace Domain\Like\Models;

use Database\Factories\Like\LikeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shared\Traits\Uuid;
use Domain\Client\Models\User;

class Like extends Model
{
    use HasFactory;
    use Uuid;
    use SoftDeletes;

    protected $table = 'likes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'likeable_type',
        'likeable_id',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function newFactory(): LikeFactory
    {
        return LikeFactory::new();
    }

    public function likeable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
