<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'superadmin',
                'email' => 'admin@localhost.com',
                'password' => bcrypt('password'),
                'verified' => '1',
            ],

        ]);


    }
}
