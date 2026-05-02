<?php

namespace Database\Seeders;

use App\Models\Pastor;
use App\Models\User;
use App\Models\Church;
use Illuminate\Database\Seeder;

class PastorSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'pastor@test.com')->first();
        $church = Church::first();

        Pastor::create([
            'user_id' => $user->id,
            'first_name' => 'John',
            'middle_name' => 'E.',
            'last_name' => 'Quiachon',
            'church_id' => $church->id,
            'type' => 'local',
            'ordination_date' => \Carbon\Carbon::now(),
        ]);
    }
}
