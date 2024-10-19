<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AreaRoleAndPermissionsSeeder extends Seeder
{

    public function run(): void
    {
        $permissions = [
            'areas' => [
                
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

        $role = Role::where('name', 'areas')->first();
        if (!$role) {
            $role = new Role();
            $role->name = "areas";
            $role->guard_name = "admin";
            $role->show = 0;
            $role->save();
        }
        $role->givePermissionTo($permissions);
    }
}
