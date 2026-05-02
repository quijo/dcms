<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $pastor = Role::firstOrCreate(['name' => 'pastor']);
        $churchTreasurer = Role::firstOrCreate(['name' => 'church-treasurer']);
        $districtTreasurer = Role::firstOrCreate(['name' => 'district-treasurer']);

        // Create permissions
        $permissions = [
            'view members',
            'create members',
            'edit members',
            'delete members',
            'view givings',
            'create givings',
            'edit givings',
            'delete givings',
            'view giving reports',
            'view churches',
            'create churches',
            'edit churches',
            'delete churches',
            'view users',
            'create users',
            'edit users',
            'delete users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign permissions to roles
        $superAdmin->givePermissionTo(Permission::all());

        $pastor->givePermissionTo([
            'view members',
            'create members',
            'edit members',
            'delete members',
        ]);

        $churchTreasurer->givePermissionTo([
            'view members',
            'view givings',
            'create givings',
            'edit givings',
            'delete givings',
            'view giving reports',
        ]);

        $districtTreasurer->givePermissionTo([
            'view givings',
            'create givings',
            'edit givings',
            'delete givings',
            'view giving reports',
            'view churches',
        ]);

        // Migrate existing users to new role system
        $users = User::all();
        foreach ($users as $user) {
            if ($user->role) {
                $user->assignRole($user->role);
            }
        }

        $this->command->info('Roles and permissions created successfully!');
        $this->command->info('Existing users migrated to new role system!');
    }
}
