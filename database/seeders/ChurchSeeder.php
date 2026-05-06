<?php

namespace Database\Seeders;

use App\Models\Church;
use Illuminate\Database\Seeder;

class ChurchSeeder extends Seeder
{
    public function run(): void
    {
        Church::create([
            'name' => 'Ambassador of Faith',
            'code' => '810-0110',
            'type' => 'organized',
            'status' => 'inactive',
        ]);

        Church::create([
            'name' => 'Argao',
            'code' => '	810-0025',
            'type' => 'mission',
            'status' => 'active',
        ]);
        Church::create([
            'name' => '	Baclayon',
            'code' => '810-0030',
            'type' => 'mission',
            'status' => 'active',
        ]);
        Church::create([
            'name' => '	Banawa',
            'code' => '810-0070',
            'type' => 'mission',
            'status' => 'active',
        ]);
        Church::create([
            'name' => '	Cebu Central Mabolo',
            'code' => '810-0100',
            'type' => 'mission',
            'status' => 'active',
        ]);
        Church::create([
            'name' => '	Consolacion',
            'code' => '810-0103',
            'type' => 'mission',
            'status' => 'active',

        ]);
        Church::create([
            'name' => '	Cordova',
            'code' => '810-0104',
            'type' => 'mission',
            'status' => 'active',
        ]);
        Church::create([
            'name' => '	Evangel Christian Community',
            'code' => '810-0019',
            'type' => 'mission',
            'status' => 'active',
        ]);
        Church::create([
            'name' => '	810-0013',
            'code' => '810-0105',
            'type' => 'mission',
            'status' => 'active',
        ]);
        Church::create([
            'name' => '	Harvest Pointe',
            'code' => '810-0013',
            'type' => 'mission',
            'status' => 'active',
        ]);
        Church::create([
            'name' => '	House of Praise',
            'code' => '810-0120',
            'type' => 'mission',
            'status' => 'active',
        ]);
        Church::create([
            'name' => 'Inayawan',
            'code' => '810-0200',
            'type' => 'mission',
            'status' => 'active',
        ]);
        Church::create([
            'name' => 'Kalunasan',
            'code' => '810-0155',
            'type' => 'mission',
            'status' => 'active',
        ]);

        Church::create([
            'name' => 'Kimba, Talisay',
            'code' => '810-0016',
            'type' => 'mission',
            'status' => 'active',
        ]);

        Church::create([
            'name' => 'Mandaue Central',
            'code' => '810-0355',
            'type' => 'mission',
            'status' => 'active',
        ]);
        Church::create([
            'name' => 'Mandaue First',
            'code' => '810-0350',
            'type' => 'mission',
            'status' => 'active',
        ]);

        Church::create([
            'name' => 'NBF - San Vicente, Liloan',
            'code' => '810-0017',
            'type' => 'mission',
            'status' => 'active',
        ]);

        Church::create([
            'name' => 'New Life',
            'code' => '810-0021',
            'type' => 'mission',
            'status' => 'active',
        ]);
        Church::create([
            'name' => 'Sandingan',
            'code' => '810-0500',
            'type' => 'mission',
            'status' => 'active',
        ]);
        Church::create([
            'name' => 'Solid Rock',
            'code' => '	810-0300',
            'type' => 'mission',
            'status' => 'active',
        ]);
        Church::create([
            'name' => 'Tak-an NCF',
            'code' => '	810-0009',
            'type' => 'mission',
            'status' => 'active',
        ]);
        Church::create([
            'name' => 'Talisay',
            'code' => '810-0915',
            'type' => 'mission',
            'status' => 'active',
        ]);
        Church::create([
            'name' => 'Tangke, Talisay City',
            'code' => '810-0018',
            'type' => 'mission',
            'status' => 'active',
        ]);
        Church::create([
            'name' => '	Tent Makers Initiative',
            'code' => '810-0102',
            'type' => 'mission',
            'status' => 'active',
        ]);
        Church::create([
            'name' => 'Word of Life',
            'code' => '	810-0920',
            'type' => 'mission',
            'status' => 'active',
        ]);
    }
}
