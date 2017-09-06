<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;
use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name'      =>  'Alex',
            'last_name'      =>  'Scott',
            'username'      =>  'root',
            'email'     =>  'root@example.com',
            'password'  =>  bcrypt('root')
        ]);

        User::create([
            'first_name'      =>  'Creamies',
            'last_name'      =>  'Crew',
            'username'      =>  'creamies',
            'email'     =>  'creamies@creamies.co.uk',
            'password'  =>  bcrypt('creamies')
        ]);

        $this->command->info('Default Users added.');

        $this->call(PermissionCategoriesTableSeeder::class);
        $this->command->info('Default permission categories added.');

        $this->call(PermissionsTableSeeder::class);
        $this->command->info('Default permissions added.');

        $this->call(RolesTableSeeder::class);
        $this->command->info('Default roles added.');

        // Seed the default permissions
        $permissions = Permission::all();
        $r = Role::where('name', '=', 'admin')->firstOrFail();

        foreach ($permissions as $perm) {
            $p = Permission::where('name', '=', $perm['name'])->firstOrFail();
            $r->attachPermission($p);
        }

        $u = User::where('username', '=', 'root')->firstOrFail();
        $u->attachRole($r);
        $this->command->info('All permissions added to admin role.');

        $faker = Faker::create();
        foreach (range(1,250) as $index) {
            DB::table('users')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'username' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('secret'),
            ]);
        }
        $this->command->info('250 random users added.');

    }
}
