<?php

use Illuminate\Database\Seeder;

class TermsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('terms')->insert([
            [
                'body' => 'Terms and Conditions Terms and Conditions Terms and Conditions Terms and Conditions Terms and Conditions',
            ],
        ]);
    }
}
