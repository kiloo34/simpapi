<?php

// namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('admin')->truncate();
        \DB::table('admin')->insert([
            [
                'nama' => 'admin',
                'no_hp' => '081234567890',
                'user_id' => 1
            ]
        ]);
    }
}
