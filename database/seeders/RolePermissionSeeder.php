<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        // Users
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);

        // Reviews
        Permission::create(['name' => 'create-product']);
        Permission::create(['name' => 'edit-product']);
        Permission::create(['name' => 'delete-product']);


        Permission::create(['name' => 'test']);
        // Create Roles
        $userRole = Role::create(['name' => 'User']);
        $vendorRole = Role::create(['name' => 'Vendor']);
        $adminRole = Role::create(['name' => 'Admin']); // gets all permissions through gate on AuthServiceProvider

        // Assign permisions to roles
        $vendorRole->givePermissionTo([
            'test',
            'create-product',
        ]);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example User',
            'email' => 'test@example.com',
        ]);

        $user2 = \App\Models\User::factory()->create([
            'name' => '1232133 User',
            'email' => 'tmiguel@example.com',
        ]);

        $user->assignRole($vendorRole);
        $user2->assignRole($vendorRole);

    }
}
