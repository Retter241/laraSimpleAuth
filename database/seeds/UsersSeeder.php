<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@mail.ru',
            'root' => 1,
            'password' => bcrypt('qwertyqwerty'),
            'created_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'user1',
            'email' => 'user1@mail.ru',
            'password' => bcrypt('qwertyqwerty'),
            'created_at' => now(),
        ]);
    }
}
