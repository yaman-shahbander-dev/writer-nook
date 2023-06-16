<?php

namespace Domain\Plan\Models;

use Database\Factories\Plan\PlanFeatureFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shared\Traits\Uuid;

class PlanFeature extends Model
{
    use HasFactory;
    use Uuid;
    use SoftDeletes;

    protected $table = 'plan_features';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'feature_id',
        'plan_id',
        'quantity',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function newFactory(): PlanFeatureFactory
    {
        return PlanFeatureFactory::new();
    }
}
