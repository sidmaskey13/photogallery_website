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
         $this->call(UserTableSeeder::class);
         $this->call(CategoryTableSeeder::class);
         $this->call(LicenseTableSeeder::class);
         $this->call(RolesAndPermissionsSeeder::class);
         $this->call(TermsSeeder::class);
    }
}

