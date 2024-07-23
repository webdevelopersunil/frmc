<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder{

    /**
     * Run the database seeds.
     */

    public function run(){
        
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define the permissions
        $permissions = [
            'create complain',
            'delete complain',
            'update complain',
            'view complain',
            'user dashboard',
            'nodal dashboard',
            'fco dashboard'
        ];

        // Create permissions if they don't exist
        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->where('guard_name', 'web')->exists()) {
                Permission::create(['name' => $permission]);
            }
        }

        // Define the roles and their permissions
        $rolesPermissions = [
            'user' => ['create complain', 'view complain'],
            'nodal' => ['delete complain', 'update complain', 'view complain'],
            'fco' => ['delete complain', 'update complain', 'view complain'],
            'super-admin' => Permission::all()->pluck('name')->toArray() // Give all permissions to super-admin
        ];

        // Create roles and assign permissions
        foreach ($rolesPermissions as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }
    }
}
