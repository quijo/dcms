<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
