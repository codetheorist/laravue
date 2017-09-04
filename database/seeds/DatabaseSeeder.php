<?php

use Illuminate\Database\Seeder;
use App\User;
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

    }
}
