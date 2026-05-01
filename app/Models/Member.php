<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'church_id',
        'first_name',
        'middle_name',
        'last_name',
        'birthdate',
        'gender',
        'email',
        'contact_number',
        'address',
        'member_status',
        'membership_date',
    ];

    //member relationships to church

    public function church()
    {
        return $this->belongsTo(Church::class);
    }

    // public function getFullNameAttribute()
    // {
    //     return trim("{$this->first_name} {$this->middle_name} {$this->last_name}");
    // }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    public function givings()
    {
        return $this->hasMany(Giving::class);
    }
}
