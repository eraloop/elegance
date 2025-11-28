<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialMediaPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view_social_posts',
            'create_social_posts',
            'delete_social_posts',
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'admin',
            ]);
        }

        // Assign to Super Admin
        $superAdmin = \Spatie\Permission\Models\Role::where('name', 'super_admin')->where('guard_name', 'admin')->first();
        if ($superAdmin) {
            $superAdmin->givePermissionTo($permissions);
        }

        // Assign to Admin
        $admin = \Spatie\Permission\Models\Role::where('name', 'admin')->where('guard_name', 'admin')->first();
        if ($admin) {
            $admin->givePermissionTo($permissions);
        }
    }
}
