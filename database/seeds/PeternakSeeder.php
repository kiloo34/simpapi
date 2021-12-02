<?php

// namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PeternakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('peternak')->truncate();
        \DB::table('peternak')->insert([
            [
                'nama_depan' => 'peternak',
                'nama_belakang' => 'peternak',
                'alamat' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Animi aperiam impedit totam et iure ex! Maiores laboriosam cumque reiciendis, aut eos atque neque, ea nobis odit iusto minima veritatis delectus.',
                'no_hp' => '081234567890',
                'user_id' => 2
            ]
        ]);
    }
}
