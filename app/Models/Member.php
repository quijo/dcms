<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $church_id
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $last_name
 * @property string|null $birthdate
 * @property string|null $gender
 * @property string|null $email
 * @property string|null $contact_number
 * @property string|null $address
 * @property string $member_status
 * @property string|null $membership_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Church $church
 * @property-read mixed $name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Giving> $givings
 * @property-read int|null $givings_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member whereBirthdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member whereChurchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member whereContactNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member whereMemberStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member whereMembershipDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
