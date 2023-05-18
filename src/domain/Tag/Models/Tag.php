<?php

namespace Domain\Tag\Models;

use Database\Factories\Tag\TagFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shared\Traits\Uuid;

class Tag extends Model
{
    use HasFactory;
    use Uuid;
    use SoftDeletes;

    protected $table = 'tags';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function newFactory(): TagFactory
    {
        return TagFactory::new();
    }
}
