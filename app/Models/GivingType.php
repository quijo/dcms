<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Giving;

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
}
