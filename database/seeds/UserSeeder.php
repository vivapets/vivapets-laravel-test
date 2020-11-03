<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'test@vivapets.com',
            'password' => Hash::make('password'),
            'type_id' => 1,
            'is_banned' => 0
        ]);
    }
}
