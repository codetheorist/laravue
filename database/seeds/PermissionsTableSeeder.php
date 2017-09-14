<?php

use App\Permission;
use App\PermissionCategory;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = array(
            [
                'name' => 'view_admin_dashboard',
                'display_name' => 'View Admin Dashboard',
                'description' => 'View Admin Dashboard',
                'category' => 'general'
            ],
            [
                'name' => 'manage_site_settings',
                'display_name' => 'Manage Site Settings',
                'description' => 'Manage Site Settings',
                'category' => 'general'
            ],
            [
                'name' => 'add_user_profile',
                'display_name' => 'Add User Profile',
                'description' => 'Add User Profile',
                'category' => 'users'
            ],
            [
                'name' => 'view_own_profile',
                'display_name' => 'View Own Profile',
                'description' => 'View Own Profile',
                'category' => 'users'
            ],
            [
                'name' => 'view_any_profile',
                'display_name' => 'View Any Profile',
                'description' => 'View Any Profile',
                'category' => 'users'
            ],
            [
                'name' => 'edit_own_profile',
                'display_name' => 'Edit Own Profile',
                'description' => 'Edit Own Profile',
                'category' => 'users'
            ],
            [
                'name' => 'edit_any_profile',
                'display_name' => 'Edit Any Profile',
                'description' => 'Edit Any Profile',
                'category' => 'users'
            ],
            [
                'name' => 'delete_own_profile',
                'display_name' => 'Delete Own Profile',
                'description' => 'Delete Own Profile',
                'category' => 'users'
            ],
            [
                'name' => 'delete_any_profile',
                'display_name' => 'Delete Any Profile',
                'description' => 'Delete Any Profile',
                'category' => 'users'
            ],
            [
                'name' => 'manage_users',
                'display_name' => 'Manage Users',
                'description' => 'Manage Users',
                'category' => 'users'
            ],
            [
                'name' => 'manage_roles',
                'display_name' => 'Manage Roles',
                'description' => 'Manage Roles',
                'category' => 'roles'
            ],
            [
                'name' => 'add_roles',
                'display_name' => 'Add Roles',
                'description' => 'Add Roles',
                'category' => 'roles'
            ],
            [
                'name' => 'view_roles',
                'display_name' => 'View Roles',
                'description' => 'View Roles',
                'category' => 'roles'
            ],
            [
                'name' => 'edit_roles',
                'display_name' => 'Edit Roles',
                'description' => 'Edit Roles',
                'category' => 'roles'
            ],
            [
                'name' => 'delete_roles',
                'display_name' => 'Delete Roles',
                'description' => 'Delete Roles',
                'category' => 'roles'
            ],
            [
                'name' => 'manage_permissions',
                'display_name' => 'Manage Permissions',
                'description' => 'Manage Permissions',
                'category' => 'permissions'
            ],
            [
                'name' => 'add_permissions',
                'display_name' => 'Add Permissions',
                'description' => 'Add Permissions',
                'category' => 'permissions'
            ],
            [
                'name' => 'view_permissions',
                'display_name' => 'View Permissions',
                'description' => 'View Permissions',
                'category' => 'permissions'
            ],
            [
                'name' => 'edit_permissions',
                'display_name' => 'Edit Permissions',
                'description' => 'Edit Permissions',
                'category' => 'permissions'
            ],
            [
                'name' => 'delete_permissions',
                'display_name' => 'Delete Permissions',
                'description' => 'Delete Permissions',
                'category' => 'permissions'
            ],
            [
                'name' => 'manage_restaurants',
                'display_name' => 'Manage Permissions',
                'description' => 'Manage Permissions',
                'category' => 'restaurants'
            ],
            [
                'name' => 'add_restaurants',
                'display_name' => 'Add Permissions',
                'description' => 'Add Permissions',
                'category' => 'restaurants'
            ],
            [
                'name' => 'view_restaurants',
                'display_name' => 'View Permissions',
                'description' => 'View Permissions',
                'category' => 'restaurants'
            ],
            [
                'name' => 'edit_restaurants',
                'display_name' => 'Edit Permissions',
                'description' => 'Edit Permissions',
                'category' => 'restaurants'
            ],
            [
                'name' => 'delete_restaurants',
                'display_name' => 'Delete Restaurants',
                'description' => 'Delete Restaurants',
                'category' => 'restaurants'
            ],
        );


        foreach($permissions as $permission) {
            $category = PermissionCategory::all()->where('name', $permission['category'])->first();
            unset($permission['category']);
            $perm = new Permission($permission);
            $category->permissions()->save($perm);
        }
    }
}
