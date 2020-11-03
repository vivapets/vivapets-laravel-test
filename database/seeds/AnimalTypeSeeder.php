<?php

use Illuminate\Database\Seeder;

class AnimalTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('animals_types')->insert([
            [
                'name' => 'Dog'
            ],
            [
                'name' => 'Cat'
            ],
            [
                'name' => 'Bird'
            ],
            [
                'name' => 'Turtle'
            ]
        ]);
    }
}
