<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    protected $fillable = [
        'name',
        'code',
        'email',
        'contact_number',
        'address',
        'city',
        'province',
        'date_established',
        'status',
    ];


    // Church Relationships to a pastor
    public function pastors()
    {
        return $this->hasMany(Pastor::class);
    }
    //Church Relationships to a member
    public function members()
    {
        return $this->hasMany(Member::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
