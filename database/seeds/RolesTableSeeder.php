<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
            [
                'name' => 'admin',
                'display_name' => 'Admin',
                'description' => 'User has full priveleges'
            ],
            [
                'name' => 'agent',
                'display_name' => 'Agent',
                'description' => 'User has priveleges required for field agents.'
            ],
            [
                'name' => 'customer_service',
                'display_name' => 'Customer Service',
                'description' => 'User role has the neccessary permissions for customer service tasks.'
            ],
            [
                'name' => 'owner',
                'display_name' => 'Owner',
                'description' => 'User is project owner'
            ],
            [
                'name' => 'customer',
                'display_name' => 'Customer',
                'description' => 'Customers can purchase menu items'
            ],
            [
                'name' => 'staff',
                'display_name' => 'Staff',
                'description' => 'Staff can manage menu items and blog posts'
            ],
            [
                'name' => 'manager',
                'display_name' => 'Manager',
                'description' => 'Managers can modify user priveleges and more'
            ]
        );


        foreach($roles as $role) {
            $r = new Role;
            $r->name = $role['name'];
            $r->display_name = $role['display_name'];
            $r->description = $role['description'];
            $r->save();
        }
    }
}
