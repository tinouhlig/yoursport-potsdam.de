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
            'first_name' => 'Tino',
            'last_name' => 'Uhlig',
            'phone' => '0172/3833626',
            'role' => 'admin',
            'slug' => 'Tino-Uhlig',
            'email' => 'tino_u@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
