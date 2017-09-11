<?php

use App\PermissionCategory;
use Illuminate\Database\Seeder;

class PermissionCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array(
            [
                'name' => 'general',
                'display_name' => 'General',
                'description' => ''
            ],
            [
                'name' => 'users',
                'display_name' => 'Users',
                'description' => ''
            ],
            [
                'name' => 'roles',
                'display_name' => 'Roles',
                'description' => ''
            ],
            [
                'name' => 'restaurants',
                'display_name' => 'Restaurants',
                'description' => ''
            ],
            [
                'name' => 'permissions',
                'display_name' => 'Permissions',
                'description' => ''
            ],
        );

        foreach($categories as $category) {
            $p = new PermissionCategory;
            $p->name = $category['name'];
            $p->display_name = $category['display_name'];
            $p->description = $category['description'];
            $p->save();
        }
    }
}
