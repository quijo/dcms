<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $church_id
 * @property int $giving_type_id
 * @property int|null $member_id
 * @property numeric $amount
 * @property string $date
 * @property string|null $receipt_number
 * @property string|null $reference_number
 * @property string|null $proof_path
 * @property string $status
 * @property int|null $approved_by
 * @property string|null $approved_at
 * @property string|null $remarks
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $approver
 * @property-read \App\Models\Church $church
 * @property-read \App\Models\GivingType $givingType
 * @property-read \App\Models\Member|null $member
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Giving newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Giving newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Giving query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Giving whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Giving whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Giving whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Giving whereChurchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Giving whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Giving whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Giving whereGivingTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Giving whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Giving whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Giving whereProofPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Giving whereReceiptNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Giving whereReferenceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Giving whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Giving whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Giving whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Giving extends Model
{
    protected $fillable = [
        'church_id',
        'giving_type_id',
        'member_id',
        'amount',
        'date',
        'receipt_number',
        'reference_number',
        'proof_path',
        'status',
        'approved_by',
        'approved_at',
        'remarks',
    ];

    public function church()
    {
        return $this->belongsTo(Church::class);
    }

    public function givingType()
    {
        return $this->belongsTo(GivingType::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
