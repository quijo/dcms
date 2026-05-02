<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string|null $code
 * @property string|null $email
 * @property string|null $contact_number
 * @property string|null $address
 * @property string|null $city
 * @property string|null $province
 * @property string|null $date_established
 * @property string $type
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Giving> $givings
 * @property-read int|null $givings_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Member> $members
 * @property-read int|null $members_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pastor> $pastors
 * @property-read int|null $pastors_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Church newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Church newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Church query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Church whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Church whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Church whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Church whereContactNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Church whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Church whereDateEstablished($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Church whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Church whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Church whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Church whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Church whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Church whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Church whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
    public function givings()
    {
        return $this->hasMany(Giving::class);
    }
}
