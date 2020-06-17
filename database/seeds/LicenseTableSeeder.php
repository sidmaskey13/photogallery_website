<?php

use Illuminate\Database\Seeder;

class LicenseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('licenses')->insert([
            [
                'name' => ' Can modify',
                'type' => '1',
            ],
            [
                'name' => ' Cant modify',
                'type' => '1',
            ],
            [
                'name' => 'Use commercially',
                'type' => '2',
            ],
            [
                'name' => 'Use non-commercially ',
                'type' => '2',

            ],

            ]);
    }
}
