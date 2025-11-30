<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $adminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
        $userRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'user']);

        $this->command->info('Roles created successfully!');
        $this->command->info('- Admin role');
        $this->command->info('- User role');

        // Create roles for admin guard
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'admin']);
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'admin']);
        $staff = Role::firstOrCreate(['name' => 'staff', 'guard_name' => 'admin']);

        // Define permission groups
        $permissions = [
            'dashboard' => [
                'view_dashboard',
            ],
            'services' => [
                'view_services',
                'create_services',
                'edit_services',
                'delete_services',
            ],
            'appointments' => [
                'view_appointments',
                'create_appointments',
                'update_appointments',
                'cancel_appointments',
            ],
            'testimonials' => [
                'view_testimonials',
                'create_testimonials',
                'edit_testimonials',
                'delete_testimonials',
            ],
            'faqs' => [
                'view_faqs',
                'create_faqs',
                'edit_faqs',
                'delete_faqs',
            ],
            'blogs' => [
                'view_blogs',
                'create_blogs',
                'edit_blogs',
                'publish_blogs',
                'delete_blogs',
            ],
            'users' => [
                'view_users',
                'create_users',
                'edit_users',
                'delete_users',
                'view_roles',
                'manage_roles',
                'assign_roles',
                'view_permissions',
                'manage_permissions',
            ],
            'media' => [
                'view_media',
                'upload_media',
                'delete_media',
            ],
            'profile' => [
                'view_profile',
                'edit_profile',
                'change_password',
            ],
            'contacts' => [
                'view_contacts',
                'delete_contacts',
            ],
            'content' => [
                'manage_content', // Main permission to see Content menu
                'manage_company_info',
                'manage_hero',
                'manage_testimonials',
                'manage_gallery',
                'manage_faqs',
                'manage_team',
            ],
            'social_media' => [
                'view_social_posts',
                'create_social_posts',
                'delete_social_posts',
            ],
            'products' => [
                'manage_products',
                'view_products',
                'create_products',
                'edit_products',
                'delete_products',
                'manage_categories',
                'manage_orders',
                'view_orders',
                'update_order_status',
            ],
        ];

        // Flatten all permissions into one list
        $allPermissions = array_merge(...array_values($permissions));

        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'admin',
            ]);
        }
        // Assign permissions

        // Super Admin: Full access
        $superAdmin->givePermissionTo(Permission::all());

        // Admin: Most management permissions
        $admin->givePermissionTo(array_merge(
            $permissions['dashboard'],
            $permissions['services'],
            $permissions['appointments'],
            $permissions['testimonials'],
            $permissions['faqs'],
            $permissions['blogs'],
            $permissions['users'],
            $permissions['media'],
            $permissions['profile'],
            $permissions['contacts'],
            $permissions['content'],
            $permissions['social_media'],
            $permissions['products'],
        ));

        // Staff: More limited access
        $staff->givePermissionTo([
            'view_dashboard',
            'view_services',
            'view_appointments',
            'update_appointments',
            'view_testimonials',
            'create_testimonials',
            'view_faqs',
            'view_blogs',
            'view_media',
            'view_profile',
            'edit_profile',
            'change_password',
        ]);

    }
}
