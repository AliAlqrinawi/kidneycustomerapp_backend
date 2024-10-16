<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\PermissionGroups;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions = [
            'system_content_management' => [
                'show_products',
                'show_products_categories',
                'show_posts',
                'show_posts_categories',
                'show_inbox',
            ],
            'system_users' => [
                'show_users'
            ],
            'institutions' => [
                'show_institutions',
                'show_areas',
                'show_providers',
            ],
            'general_settings' => [
                'show_pages',
                'show_settings',
                'show_questionnaire_forms',
                'show_blood_types',
                'show_types_health_insurance'
            ],
            'managing_system_administrators' => [
                'show_admins',
                'show_roles',
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
        //
        $admin = Admin::where('email', 'info@admin.com')->first();
        $role = Role::where('name', 'admins')->first();
        if (!$admin) {
            $admin = new Admin();
            $admin->name = 'Admin';
            $admin->email = 'info@admin.com';
            $admin->password = Hash::make('123456');
            $admin->save();
        }
        if (!$role) {
            $role = new Role();
            $role->name = "admins";
            $role->guard_name = "admin";
            $role->save();
        }
        $role->givePermissionTo($permissions);



        $admin->assignRole($role);

    }
}
