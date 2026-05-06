<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GivingType;

class GivingTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'District Budget',
            'Educational Budget',
            'World Evangelism Fund',
            'Alabaster',
            'Nazarene Youth International',
            'Nazarene Mission International',
            'Nazarene Discipleship International',
            'Open Hand Project',
            'Thanksgiving',
            'Donations',
            'District Compassionate Ministry',
            'Other'
        ];

        foreach ($types as $type) {
            GivingType::firstOrCreate([
                'name' => $type
            ]);
        }
    }
}
