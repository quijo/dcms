<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class FiscalYear extends Model
{
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'is_active',
    ];

    public static function findByDate($date)
    {
        $date = Carbon::parse($date)->toDateString();

        return self::whereDate('start_date', '<=', $date)
            ->whereDate('end_date', '>=', $date)
            ->first();
    }

    public static function active()
    {
        return static::where('is_active', true)->first();
    }
    public function givings()
    {
        return $this->hasMany(Giving::class);
    }

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     $date = $data['date'] ?? now();

    //    $data['fiscal_year_id'] =
    // FiscalYear::findByDate($date)?->id
    // ?? FiscalYear::latest('start_date')->first()?->id;

    //     return $data;
    // }
}
