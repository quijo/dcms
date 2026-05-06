<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        $churchTreasurer = Role::firstOrCreate(['name' => 'local-treasurer']);
        $churchSecretary = Role::firstOrCreate(['name' => 'local-secretary']);
        $districtTreasurer = Role::firstOrCreate(['name' => 'district-treasurer']);
        $districtSecretary = Role::firstOrCreate(['name' => 'district-secretary']);
        $ds = Role::firstOrCreate(['name' => 'district-superintendent']);

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
            'create pastors',
            'edit pastors',
            'delete pastors',
            'view pastors',
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
            'view givings',
            'create givings',
            'edit givings',
            'delete givings',

        ]);

        $ds->givePermissionTo([
            'view members',
            'view givings',
            'view giving reports',
            'view churches',
            'view pastors',
        ]);

        $churchTreasurer->givePermissionTo([
            'view members',
            'view givings',
            'create givings',
            'edit givings',
            'delete givings',
            'view pastors',

        ]);
        $churchSecretary->givePermissionTo([
            'view members',
            'create members',
            'delete members',
            'edit members',
            'view pastors',
            'view givings',
        ]);

        $districtTreasurer->givePermissionTo([
            'view givings',
            'create givings',
            'edit givings',
            'delete givings',
            'view giving reports',
            'view churches',
            'view pastors',
            'view members',
        ]);

        $districtSecretary->givePermissionTo([
            'view members',
            'create members',
            'edit members',
            'delete members',
            'view pastors',
            'create pastors',
            'edit pastors',
            'delete pastors',
            'view churches',
            'create churches',
            'edit churches',
            'delete churches',
            'view givings',
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
