<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('role')->truncate();
        \DB::table('role')->insert([
            [
                'nama' => 'admin'
            ],
            [
                'nama' => 'peternak'
            ]
        ]);
    }
}
