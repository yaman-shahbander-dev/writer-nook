<?php

namespace Domain\Plan\Models;

use Carbon\Carbon;
use Database\Factories\Plan\UserPlanMonthFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shared\Traits\Uuid;

class UserPlanMonth extends Model
{
    use HasFactory;
    use Uuid;
    use SoftDeletes;

    protected $table = 'user_plan_months';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_plan_id',
        'subscribed_at',
        'expired_at',
        'features',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function newFactory(): UserPlanMonthFactory
    {
        return UserPlanMonthFactory::new();
    }

    public function subscribedAt(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return Carbon::parse($value)->format('Y-m-d\TH:i:sP');
            }
        );
    }

    public function expiredAt(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return Carbon::parse($value)->format('Y-m-d\TH:i:sP');
            }
        );
    }
}
