<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Define permission groups
        $permissions = [
            'dashboard' => [
                'view_dashboard',
            ],
            'services' => [
                'view_services', 'create_services', 'edit_services', 'delete_services',
            ],
            'appointments' => [
                'view_appointments', 'create_appointments', 'update_appointments', 'cancel_appointments',
            ],
            'testimonials' => [
                'view_testimonials', 'create_testimonials', 'edit_testimonials', 'delete_testimonials',
            ],
            'faqs' => [
                'view_faqs', 'create_faqs', 'edit_faqs', 'delete_faqs',
            ],
            'blogs' => [
                'view_blogs', 'create_blogs', 'edit_blogs', 'publish_blogs', 'delete_blogs',
            ],
            'users' => [
                'view_users', 'create_users', 'edit_users', 'delete_users',
                'view_roles', 'manage_roles', 'assign_roles',
                'view_permissions', 'manage_permissions',
            ],
            'media' => [
                'view_media', 'upload_media', 'delete_media',
            ],
            'profile' => [
                'view_profile', 'edit_profile', 'change_password',
            ],
        ];


        $allPermissions = array_merge(...array_values($permissions));

        // Create permissions
        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'admin',
            ]);
        }
    }
}
