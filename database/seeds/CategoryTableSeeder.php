<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Abstract',
               ],
            [
                'name' => 'Animal',
            ],
            [
                'name' => 'Architecture',
            ],
            [
                'name' => 'Art',
            ],
            [
                'name' => 'Culture',
            ],
            [
                'name' => 'Disaster',
            ],
            [
                'name' => 'Education',
            ],
            [
                'name' => 'Entertainment ',
            ],
            [
                'name' => 'Fashion',
            ],
            [
                'name' => 'Food',
            ],
            [
                'name' => 'Health',
            ],
            [
                'name' => 'Landscape',
            ],
            [
                'name' => 'Nature',
            ],
            [
                'name' => 'Politics',
            ],
            [
                'name' => 'Portrait',
            ],
            [
                'name' => 'Science',
            ],
            [
                'name' => 'Sports',
            ],
            [
                'name' => 'Studio',
            ],
            [
                'name' => 'Technology',
            ],
            [
                'name' => 'Transportation',
            ],
            [
                'name' => 'Travel',
            ],
            [
                'name' => 'War',
            ],

        ]);
    }
}
