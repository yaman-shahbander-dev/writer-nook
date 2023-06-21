<?php

namespace Domain\Plan\Models;

use Database\Factories\Plan\FeatureFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shared\Traits\Uuid;

class Feature extends Model
{
    use HasFactory;
    use Uuid;
    use SoftDeletes;

    protected $table = 'features';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'key',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function newFactory(): FeatureFactory
    {
        return FeatureFactory::new();
    }

    public function plans(): BelongsToMany
    {
        return $this->belongsToMany(Plan::class, 'plan_features');
    }
}
