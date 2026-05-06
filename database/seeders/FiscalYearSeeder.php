<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FiscalYear;

class FiscalYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FiscalYear::create([
            'name' => '2024-2025',
            'start_date' => '2024-06-01',
            'end_date' => '2025-05-31',
        ]);

        FiscalYear::create([
            'name' => '2025-2026',
            'start_date' => '2025-06-01',
            'end_date' => '2026-05-31',
        ]);
    }
}
