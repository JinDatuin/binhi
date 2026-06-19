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
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $roles = config('member.permissions');

        $allPermissions = [];

        // 1. CREATE ALL PERMISSIONS FIRST
        foreach ($roles as $roleName => $resources) {
            if ($resources === ['*']) {
                continue;
            }

            foreach ($resources as $resource => $actions) {
                foreach ($actions as $action) {
                    $permission = "{$resource}.{$action}";

                    Permission::findOrCreate($permission, 'web');

                    $allPermissions[] = $permission;
                }
            }
        }

        // 2. CREATE ROLES + ASSIGN PERMISSIONS
        foreach ($roles as $roleName => $resources) {
            $role = Role::findOrCreate($roleName, 'web');

            // Admin gets everything
            if ($resources === ['*']) {
                $role->syncPermissions(Permission::all());

                continue;
            }

            $permissions = [];

            foreach ($resources as $resource => $actions) {
                foreach ($actions as $action) {
                    $permissions[] = "{$resource}.{$action}";
                }
            }

            $role->syncPermissions($permissions);
        }
    }
}
