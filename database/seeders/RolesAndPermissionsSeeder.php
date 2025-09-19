<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions
        Permission::create(['name' => 'user_management_menu']);
        Permission::create(['name' => 'manage_permissions']);
        Permission::create(['name' => 'manage_roles']);
        Permission::create(['name' => 'manage_users']);
        Permission::create(['name' => 'manage_stores']);
        Permission::create(['name' => 'view_reports']);
        Permission::create(['name' => 'manage_products']);
        Permission::create(['name' => 'manage_stock']);
        Permission::create(['name' => 'manage_transactions']);
        Permission::create(['name' => 'create_transaction']);
        Permission::create(['name' => 'view_products']);

        // Roles
        $superadmin = Role::create(['name' => 'superadmin']);
        $superadmin->givePermissionTo(Permission::all());

        $owner = Role::create(['name' => 'owner']);
        $owner->givePermissionTo([
            'user_management_menu',
            'view_reports',
            'manage_products',
            'manage_stock',
            'manage_transactions',
            'manage_users',
            'manage_roles'
        ]);

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            'manage_products',
            'manage_stock',
            'manage_transactions',
            'view_products'
        ]);

        $kasir = Role::create(['name' => 'kasir']);
        $kasir->givePermissionTo([
            'create_transaction',
            'view_products'
        ]);
    }
}