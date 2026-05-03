<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Giving;

/**
 * @property int $id
 * @property string $name
 * @property string|null $code
 * @property int $is_custom
 * @property string|null $category
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Church|null $church
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Giving> $givings
 * @property-read int|null $givings_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GivingType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GivingType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GivingType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GivingType whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GivingType whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GivingType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GivingType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GivingType whereIsCustom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GivingType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GivingType whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GivingType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GivingType extends Model
{
    protected $fillable = [
        'name',
        'code',
        'category',
        'is_custom',
        'status',
    ];

    public function givings()
    {
        return $this->hasMany(Giving::class);
    }

    public function church()
    {
        return $this->belongsTo(Church::class);
    }

    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class);
    }
}
