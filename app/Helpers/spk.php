<?php

namespace App\Helpers;

use App\Models\Alternatif;
use App\Models\Kategori;
use App\Models\Kriteria;
use App\Models\PerbandinganAlternatif;
use App\Models\PerbandinganKategori;
use App\Models\PerbandinganKriteria;
use App\Models\PerbandinganSubkriteria;
use App\Models\PrioritasAlternatif;
use App\Models\Subkriteria;

use function PHPUnit\Framework\isEmpty;

// use Illuminate\Support\Facades\DB;

class spk
{
    public function ir($jumlah)
    {
        switch ($jumlah) {
            case $jumlah == 1 || $jumlah == 2:
                return $nilai = 0;
                break;
            case $jumlah == 3:
                return $nilai = 0.58;
                break;
            case $jumlah == 4:
                return $nilai = 0.90;
                break;
            case $jumlah == 5:
                return $nilai = 1.12;
                break;
            case $jumlah == 6:
                return $nilai = 1.24;
                break;
            case $jumlah == 7:
                return $nilai = 1.32;
                break;
            case $jumlah == 8:
                return $nilai = 1.41;
                break;
            case $jumlah == 9:
                return $nilai = 1.45;
                break;
            case $jumlah == 10:
                return $nilai = 1.49;
                break;
            case $jumlah == 11:
                return $nilai = 1.51;
                break;
            case $jumlah == 12:
                return $nilai = 1.48;
                break;
            case $jumlah == 13:
                return $nilai = 1.56;
                break;
            case $jumlah == 14:
                return $nilai = 1.57;
                break;
            case $jumlah == 15:
                return $nilai = 1.59;
                break;

            default:
                "<span>Erorr IR jumlah</span>";
                break;
        }
    }

    public function getNilaiPerbandinganKriteria($k1, $k2)
    {
        $dk1 = Kriteria::findOrFail($k1);
        $dk2 = Kriteria::findOrFail($k2);

        $data = PerbandinganKriteria::where([
            ['kriteria_id1', '=', $dk1->id],
            ['kriteria_id2', '=', $dk2->id]
        ])->get('nilai');
        // dd($data[0]->nilai);
        return $data->isEmpty() ? null : $data;
    }

    public function inputDataPerbandinganKriteria($k1, $k2, $nilai)
    {
        // dd($nilai);
        $dk1 = Kriteria::findOrFail($k1);
        $dk2 = Kriteria::findOrFail($k2);
        // dd($dk1, $dk2, $nilai);
        $data = PerbandinganKriteria::updateOrCreate([
            'kriteria_id1' => $dk1->id,
            'kriteria_id2' => $dk2->id,
            'nilai' => $nilai
        ]);
    }

    public function getNilaiPerbandinganSubkriteria($sk1, $sk2)
    {
        // dd('masuk');
        $dk1 = Subkriteria::findOrFail($sk1);
        $dk2 = Subkriteria::findOrFail($sk2);

        $data = PerbandinganSubkriteria::where([
            ['subkriteria_id1', '=', $dk1->id],
            ['subkriteria_id2', '=', $dk2->id]
        ])->get('nilai');

        // dd($data->isEmpty());

        return $data->isEmpty() ? null : $data;
    }

    public function inputDataPerbandinganSubkriteria($sk1, $sk2, $nilai)
    {
        // dd($nilai);
        $dk1 = Subkriteria::findOrFail($sk1);
        $dk2 = Subkriteria::findOrFail($sk2);
        // dd($dk1, $dk2, $nilai);
        $data = PerbandinganSubkriteria::updateOrCreate([
            'subkriteria_id1' => $dk1->id,
            'subkriteria_id2' => $dk2->id,
            'nilai' => $nilai
        ]);
    }

    //on progress
    public function getNilaiPerbandinganKategoriKriteria($sk1, $sk2)
    {
        $dk1 = Kategori::findOrFail($sk1);
        $dk2 = Kategori::findOrFail($sk2);
        // dd($dk1, $dk2);
        $data = PerbandinganKategori::where([
            ['kategori_id1', '=', $dk1->id],
            ['kategori_id2', '=', $dk2->id],
        ])->get('nilai');

        // dd($data->isEmpty());

        return $data->isEmpty() ? null : $data;
    }
    //on progress
    public function inputDataPerbandinganKategoriKriteria($k1, $k2, $nilai, $kode)
    {
        // dd($k1, $k2, $nilai, $kode);
        $dk1 = Kategori::findOrFail($k1);
        $dk2 = Kategori::findOrFail($k2);
        // dd($dk1, $dk2, $nilai);
        $data = PerbandinganKategori::updateOrCreate([
            'kategori_id1' => $dk1->id,
            'kategori_id2' => $dk2->id,
            'nilai' => $nilai,
            'kode' => $kode
        ]);
    }

    //on progress
    public function getNilaiPerbandinganKategoriSubkriteria($sk1, $sk2)
    {
        // dd('masuk');
        $dk1 = Kategori::findOrFail($sk1);
        $dk2 = Kategori::findOrFail($sk2);

        $data = PerbandinganKategori::where([
            ['kategori_id1', '=', $dk1->id],
            ['kategori_id2', '=', $dk2->id],
        ])->get('nilai');

        // dd($data->isEmpty());

        return $data->isEmpty() ? null : $data;
    }
    //on progress
    public function inputDataPerbandinganKategoriSubkriteria($sk1, $sk2, $nilai, $kode)
    {
        // dd($nilai);
        $dk1 = Kategori::findOrFail($sk1);
        $dk2 = Kategori::findOrFail($sk2);
        // dd($dk1, $dk2, $nilai, $kode);
        $data = PerbandinganKategori::updateOrCreate([
            'kategori_id1' => $dk1->id,
            'kategori_id2' => $dk2->id,
            'nilai' => $nilai,
            'kode' => $kode
        ]);
    }

    public function getNilaiPerbandinganAlternatif($a1, $a2, $kode)
    {
        $da1 = Alternatif::findOrFail($a1);
        $da2 = Alternatif::findOrFail($a2);

        $dkode = Kriteria::where('kode', $kode)->get();
        if ($dkode->isEmpty()) {
            $dkode = Subkriteria::where('kode', $kode)->get();
        }
        // dd($dkode, $kode);
        // dd($da1, $da2);

        $data = PerbandinganAlternatif::where([
            ['alternatif_id1', '=', $da1->id],
            ['alternatif_id2', '=', $da2->id],
            ['kode', '=', $kode]
        ])->get('nilai');

        return $data->isEmpty() ? null : $data;
    }

    public function InputDataPerbandinganAlternatif($a1, $a2, $kode, $nilai)
    {
        $da1 = Alternatif::findOrFail($a1);
        $da2 = Alternatif::findOrFail($a2);

        $dkode = Kriteria::where('kode', $kode)->get();
        if ($dkode->isEmpty()) {
            $dkode = Subkriteria::where('kode', $kode)->get();
        }

        $data = PerbandinganAlternatif::updateOrCreate([
            'alternatif_id1' => $da1->id,
            'alternatif_id2' => $da2->id,
            'nilai' => $nilai,
            'kode' => $kode
        ]);
    }

    public function getDataAllKriteria()
    {
        $data1 = \DB::table('kriteria')->whereNotNull('kode')->get();
        $data2 = \DB::table('subkriteria')->get();

        $kriteria = $data2->merge($data1)->sortBy('kode');

        return $kriteria;
    }

    public function getBobotAlternatif($ka, $kk)
    {
        $data = \DB::table('prioritas_alternatif')
            ->where([
                ['kode_alt', $ka],
                ['kode_kri', $kk]
            ])
            ->first();
        return $data;
    }

    public function cekKriteria($k1)
    {
        // dd($k1);
        $value = Kriteria::where('nama', $k1->nama)->exists();
        return $value;
    }

    public function cekSubkriteria($sk1)
    {
        $value = Subkriteria::where('nama', $sk1->nama)->exists();
        return $value;
    }

    public function getLamda($jumlahAkhir, $jumlah)
    {
        $nilai = $jumlahAkhir / $jumlah;
        return $nilai;
    }

    public function getCI($lamda, $jumlah)
    {
        $nilai = ($lamda - $jumlah) / $jumlah;
        return $nilai;
    }

    public function getCR($ci, $jumlah)
    {
        if ($this->ir($jumlah) == 0) {
            $nilai = 'tidak terdefinisikan';
        } else {
            $nilai = $ci / $this->ir($jumlah);
        }
        return $nilai;
    }
}
