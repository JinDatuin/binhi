<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'view dashboard',
            'manage users',
            'manage reports',
            'manage settings',
            'manage members',
        ];

        foreach ($permissions as $name) {
            Permission::findOrCreate($name);
        }

        // Flush Spatie permission cache
        app()->make(PermissionRegistrar::class)->forgetCachedPermissions();

        $admin = Role::findOrCreate('admin');
        $admin->syncPermissions($permissions);

        $secretary = Role::findOrCreate('secretary');
        $secretary->syncPermissions(['view dashboard', 'manage reports', 'manage members']);

        $member = Role::findOrCreate('member');
        $member->syncPermissions(['view dashboard']);
    }
}
