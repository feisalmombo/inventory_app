<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
          $this->call(BanksTableSeeder::class);
          $this->call(RolesTableSeeder::class);
          $this->call(ProductStatusTableSeeder::class);
          $this->call(RolesTableSeeder::class);
          $this->call(ConditionsTableSeeder::class);
          $this->call(PermissionsTableSeeder::class);
          $this->call(UserStatusTableSeeder::class);
          $this->call(UsersTableSeeder::class);
    }
}
