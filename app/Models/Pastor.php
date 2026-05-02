<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $church_id
 * @property string $first_name
 * @property string $Middle_name
 * @property string $last_name
 * @property string|null $email
 * @property string|null $contact_number
 * @property string $role
 * @property string $type
 * @property string|null $ordination_date
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $user_id
 * @property-read \App\Models\Church $church
 * @property-read mixed $full_name
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pastor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pastor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pastor query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pastor whereChurchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pastor whereContactNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pastor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pastor whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pastor whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pastor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pastor whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pastor whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pastor whereOrdinationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pastor whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pastor whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pastor whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pastor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pastor whereUserId($value)
 * @mixin \Eloquent
 */
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
        'type'
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
