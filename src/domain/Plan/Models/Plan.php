<?php

namespace Domain\Plan\Models;

use Database\Factories\Plan\PlanFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shared\Traits\Uuid;

class Plan extends Model
{
    use HasFactory;
    use Uuid;
    use SoftDeletes;

    protected $table = 'plans';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'stripe_price_plan',
        'type',
        'duration',
        'hidden_at',
        'name',
        'description',
        'base_price',
        'discount',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function newFactory(): PlanFactory
    {
        return PlanFactory::new();
    }

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class, 'plan_features')
            ->using(new class extends Pivot {
               use Uuid;
            });
    }

    public function userPlans(): HasMany
    {
        return $this->hasMany(UserPlan::class);
    }

    public function userPlanMonths(): HasManyThrough
    {
        return $this->hasManyThrough(
            UserPlanMonth::class,
            UserPlan::class,
            'plan_id',
            'user_plan_id',
            'id',
            'id'
        );
    }
}
