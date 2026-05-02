<?php

namespace Database\Seeders;

use App\Models\Church;
use Illuminate\Database\Seeder;

class ChurchSeeder extends Seeder
{
    public function run(): void
    {
        Church::create([
            'name' => 'Central Church',
            'type' => 'organized',
            'status' => 'active',
        ]);

        Church::create([
            'name' => 'North Mission Church',
            'type' => 'mission',
            'status' => 'active',
        ]);
    }
}
