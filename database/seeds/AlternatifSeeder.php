<?php

// namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('alternatif')->truncate();
        \DB::table('alternatif')->insert([
            [
                'kode' => 'A01',
                'nama' => 'Simental'
            ],
            [
                'kode' => 'A02',
                'nama' => 'Lemosin'
            ]
        ]);
    }
}
