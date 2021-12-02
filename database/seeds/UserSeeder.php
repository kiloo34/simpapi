<?php

// namespace Database\Seeders;

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
        // $avatar = new ;

        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('users')->truncate();
        \DB::table('users')->insert([
            [
                'email' => 'admin@admin.com',
                'username' => 'admin',
                'password' => \Hash::make('12345678'),
                'avatar' => 'https://ui-avatars.com/api/?name=admin',
                'role_id' => 1
            ],
            [
                'email' => 'peternak@peternak.com',
                'username' => 'peternak',
                'password' => \Hash::make('12345678'),
                'avatar' => 'https://ui-avatars.com/api/?name=peternak',
                'role_id' => 2
            ]
        ]);
    }
}
