<?php

namespace Domain\Client\Models;

use Database\Factories\Client\BecomeAuthorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shared\Traits\Uuid;

class BecomeAuthor extends Model
{
    use HasFactory;
    use Uuid;
    use SoftDeletes;

    protected $table = 'become_authors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'title',
        'description',
        'user_id',
        'approved',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function newFactory(): BecomeAuthorFactory
    {
        return BecomeAuthorFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
