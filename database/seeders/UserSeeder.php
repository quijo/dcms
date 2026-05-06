<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'type' => 'system',
                'church_id' => null,
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('super-admin');

        // District Superintendent
        $ds = User::firstOrCreate(
            ['email' => 'ds@test.com'],
            [
                'name' => 'District Superintendent',
                'password' => Hash::make('password'),
                'type' => 'system',
                'church_id' => null,
                'email_verified_at' => now(),
            ]
        );
        $ds->assignRole('district-superintendent'); // or create separate role if needed

        // District Treasurer
        $districtTreasurer = User::firstOrCreate(
            ['email' => 'treasurer@test.com'],
            [
                'name' => 'District Treasurer',
                'password' => Hash::make('password'),
                'type' => 'district',
                'church_id' => null,
                'email_verified_at' => now(),
            ]
        );
        $districtTreasurer->assignRole('district-treasurer');

        // Pastor
        $pastor = User::firstOrCreate(
            ['email' => 'pastor@test.com'],
            [
                'name' => 'Local Pastor',
                'password' => Hash::make('password'),
                'type' => 'local',
                'church_id' => 1,
                'email_verified_at' => now(),
            ]
        );
        $pastor->assignRole('pastor');

        // Local Treasurer
        $localTreasurer = User::firstOrCreate(
            ['email' => 'localtreasurer@test.com'],
            [
                'name' => 'Local Treasurer',
                'password' => Hash::make('password'),
                'type' => 'local',
                'church_id' => 1,
                'email_verified_at' => now(),
            ]
        );
        $localTreasurer->assignRole('local-treasurer');

        // District Secretary
        $districtSecretary = User::firstOrCreate(
            ['email' => 'districtsecretary@test.com'],
            [
                'name' => 'District Secretary',
                'password' => Hash::make('password'),
                'type' => 'district',
                'church_id' => null,
                'email_verified_at' => now(),
            ]
        );
        $districtSecretary->assignRole('district-secretary');

        // Local Secretary
        $localSecretary = User::firstOrCreate(
            ['email' => 'localsecretary@test.com'],
            [
                'name' => 'Local Secretary',
                'password' => Hash::make('password'),
                'type' => 'local',
                'church_id' => 1,
                'email_verified_at' => now(),
            ]
        );
        $localSecretary->assignRole('local-secretary');
    }
}
