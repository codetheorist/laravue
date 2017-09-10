<?php

// Load required app models
use App\Permission;
use App\Role;
use App\User;

// Load Laravel utility classes
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

// Load Faker
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Call Permission Categories seeder
    $this->call(CountriesTableSeeder::class);
    $this->command->info('Default countries added.');

    // Call Permission Categories seeder
    $this->call(PermissionCategoriesTableSeeder::class);
    $this->command->info('Default permission categories added.');

    // Call Permissions seeder
    $this->call(PermissionsTableSeeder::class);
    $this->command->info('Default permissions added.');

    // Call Roles seeder
    $this->call(RolesTableSeeder::class);
    $this->command->info('Default roles added.');

    // Seed the default permissions
    $permissions = Permission::all();
    $r = Role::where('name', '=', 'admin')->firstOrFail();

    foreach ($permissions as $perm) {
      $p = Permission::where('name', '=', $perm['name'])->firstOrFail();
      $r->attachPermission($p);
    }

    // Setup our variables
    $faker = Faker::create();
    $users = [];

    // Store password for our random users in a variable to decrease seed
    // time by hashing only once
    $password = bcrypt('secret');

    // Compile our array of users, starting with our 'real' users.
    $users[] = [
      'first_name'      =>  'Alex',
      'last_name'      =>  'Scott',
      'username'      =>  'root',
      'email'     =>  'root@example.com',
      'occupation' => $faker->jobTitle,
      'password'  =>  bcrypt('root')
    ];

    $users[] = [
      'first_name'      =>  'Creamies',
      'last_name'      =>  'Crew',
      'username'      =>  'creamies',
      'email'     =>  'creamies@creamies.co.uk',
      'occupation' => $faker->jobTitle,
      'password'  =>  bcrypt('creamies')
    ];

    // Add our 250 random users into the mix
    foreach (range(1,5000) as $index) {
      $users[] = [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'username' => $faker->unique()->userName,
        'email' => $faker->unique()->email,
        'occupation' => $faker->jobTitle,
        'password' => $password
      ];
    }

    // Create all of our users, in one query
    User::insert($users);
    $this->command->info('Admin, Owner & 5000 random users added.');

    // Attach our admin role to our 'root' user
    $u = User::where('username', '=', 'root')->firstOrFail();
    $u->attachRole($r);
    $this->command->info('All permissions added to admin role.');

    // Randomize user creation dates
    $all = User::all();
    foreach ($all as $user) {
      $user->created_at = $faker->dateTimeBetween($startDate = '-2 months', $endDate = 'now', $timezone = date_default_timezone_get());
      $user->updated_at = $faker->dateTimeBetween($startDate = $user->created_at, $endDate = 'now', $timezone = date_default_timezone_get());
      $user->save();
    }
    $this->command->info('Randomized user timestamps.');

    $this->command->warn('Please ensure you change the default root user password.');
  }
}
