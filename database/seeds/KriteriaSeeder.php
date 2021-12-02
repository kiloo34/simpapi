<?php

// namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('kriteria')->truncate();
        \DB::table('kriteria')->insert([
            [
                'kode' => 'C01',
                'nama' => 'harga'
            ],
            [
                'kode' => null,
                'nama' => 'Postur'
            ],
            [
                'kode' => null,
                'nama' => 'Kepala'
            ],
            [
                'kode' => 'C11',
                'nama' => 'Umur'
            ],
            [
                'kode' => 'C12',
                'nama' => 'Warna'
            ]
        ]);
    }
}
