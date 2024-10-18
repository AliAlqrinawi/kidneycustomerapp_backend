<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class InstitutionRoleAndPermissionsSeeder extends Seeder
{

    public function run(): void
    {
        $permissions = [
            'system_users' => [
                'show_users'
            ],
            'institutions' => [
                'show_areas',
                'show_providers',
                'show_aiTests',
                'show_appointments'
            ],
        ];

        foreach ($permissions as $key => $value) {

            foreach ($value as $permission) {
                $permission_obj = Permission::firstOrCreate([
                    'name' => $permission,
                    'guard_name' => 'admin',
                    'group_key' => $key
                ]);
            }
        }

        $role = Role::where('name', 'institutions')->first();
        if (!$role) {
            $role = new Role();
            $role->name = "institutions";
            $role->guard_name = "admin";
            $role->show = 0;
            $role->save();
        }
        $role->givePermissionTo($permissions);
    }
}
