<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin (system-wide access)
        User::firstOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role' => 'super-admin',
                'type' => 'system',
                'church_id' => null,
                'email_verified_at' => now(),
            ]
        );

        // District Treasurer
        User::firstOrCreate(
            ['email' => 'treasurer@test.com'],
            [
                'name' => 'District Treasurer',
                'password' => Hash::make('password'),
                'role' => 'district-treasurer',
                'type' => 'district',
                'church_id' => null,
                'email_verified_at' => now(),
            ]
        );

        // Pastor (example)
        User::firstOrCreate(
            ['email' => 'pastor@test.com'],
            [
                'name' => 'Local Pastor',
                'password' => Hash::make('password'),
                'role' => 'pastor',
                'type' => 'local',
                'church_id' => 1, // assign existing church
                'email_verified_at' => now(),
            ]
        );

        // Local Treasurer
        User::firstOrCreate(
            ['email' => 'localtreasurer@test.com'],
            [
                'name' => 'Local Treasurer',
                'password' => Hash::make('password'),
                'role' => 'local-treasurer',
                'type' => 'local',
                'church_id' => 1,
                'email_verified_at' => now(),
            ]
        );

        // District Secretary
        User::firstOrCreate(
            ['email' => 'districtsecretary@test.com'],
            [
                'name' => 'District Secretary',
                'password' => Hash::make('password'),
                'role' => 'district-secretary',
                'type' => 'district',
                'church_id' => null,
                'email_verified_at' => now(),
            ]
        );
        // Local Secretary
        User::firstOrCreate(
            ['email' => 'localsecretary@test.com'],
            [
                'name' => 'Local Secretary',
                'password' => Hash::make('password'),
                'role' => 'local-secretary',
                'type' => 'local',
                'church_id' => 1,
                'email_verified_at' => now(),
            ]
        );
    }
}
