<?php

// namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubkriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('subkriteria')->truncate();
        \DB::table('subkriteria')->insert([
            [
                'kode' => 'C02',
                'nama' => 'kaki',
                'kriteria_id' => 2
            ],
            [
                'kode' => 'C03',
                'nama' => 'leher',
                'kriteria_id' => 2
            ],
            [
                'kode' => 'C04',
                'nama' => 'punggung',
                'kriteria_id' => 2
            ],
            [
                'kode' => 'C05',
                'nama' => 'dada',
                'kriteria_id' => 2
            ],
            [
                'kode' => 'C06',
                'nama' => 'pantat',
                'kriteria_id' => 2
            ],
            [
                'kode' => 'C07',
                'nama' => 'ekor',
                'kriteria_id' => 2
            ],
            [
                'kode' => 'C08',
                'nama' => 'cingur',
                'kriteria_id' => 3
            ],
            [
                'kode' => 'C09',
                'nama' => 'dahi',
                'kriteria_id' => 3
            ],
            [
                'kode' => 'C10',
                'nama' => 'telinga',
                'kriteria_id' => 3
            ]
        ]);
    }
}
