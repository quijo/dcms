<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pastor extends Model
{
    protected $fillable = [
        'church_id',
        'first_name',
        'Middle_name',
        'last_name',
        'email',
        'contact_number',
        'role',
        'ordination_date',
        'status',
    ];

    //pastor relationships to church
    public function church()
    {
        return $this->belongsTo(Church::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->middle_name}{$this->last_name}";
    }
}
