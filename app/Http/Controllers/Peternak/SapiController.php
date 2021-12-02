<?php

namespace App\Http\Controllers\Peternak;

use App\Helpers\spk;
use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\Kategori;
use App\Models\Sapi;
use Illuminate\Http\Request;

class SapiController extends Controller
{
    public function index()
    {
        return view('peternak.sapi.index', [
            'title' => 'sapi',
            'subtitle' => '',
            'active' => 'sapi',
            'data' => Sapi::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function manual()
    {
        return view('peternak.sapi.manual', [
            'title' => 'sapi',
            'subtitle' => 'create',
            'active' => 'sapi',
            'alternatif' => Alternatif::all()
        ]);
    }

    public function rekomendasi(Request $r)
    {
        $r->validate([
            'jumlah' => 'required|numeric'
        ]);

        $spk = new spk;
        $kriteria = $spk->getDataAllKriteria();
        $alternatif = Alternatif::all();
        $kategori = Kategori::all();

        return view('peternak.sapi.rekomendasi', [
            'title' => 'sapi',
            'subtitle' => 'create',
            'active' => 'sapi',
            'kriteria' => $kriteria,
            'alternatif' => $alternatif,
            'kategori' => $kategori,
            'jumlah' => $r->jumlah,
            'spk' => $spk
        ]);
    }

    public function store(Request $r)
    {
        $r->validate([
            'alternatif' => 'required',
            'harga' => 'required|numeric|min:0'
        ]);

        // dd('masuk gan');

        Sapi::create([
            'nama' => $r->alternatif,
            'harga_beli' => $r->harga,
            'user_id' => auth()->user()->id
        ]);

        if ($r->rekomendasi == 'rekomendasi') {
            // dd('masuk rekomendasi');
            return redirect()->back()->with('success_msg', 'data sapi berhasil ditambah');
        } else {
            // dd('masuk manual');
            return redirect()->route('sapi.index')->with('success_msg', 'data sapi berhasil ditambah');
        }
    }

    public function hitung(Request $r)
    {
        $spk = new spk;
        $dataKriteria = $spk->getDataAllKriteria();
        $dataKategori = Kategori::all();
        $data = $r->all();

        // $kriteria = array();
        $pilihan = array();
        // $hasil = (object) array();

        for ($i = 0; $i < count($r->alternatif); $i++) {
            $pilihan[$i] = 0;
            // $sorted[$i] = 0;
        }

        for ($i = 0; $i < count($r->alternatif); $i++) {
            for ($j = 0; $j < count($dataKriteria); $j++) {
                if ($dataKriteria[$j]->nama == 'harga') {
                    // convert input to bobot
                    $min = $dataKategori->where('kriteria_id', '=', $dataKriteria[$j]->id)->min('nama');
                    $max = $dataKategori->where('kriteria_id', '=', $dataKriteria[$j]->id)->max('nama');
                    $rep = $dataKategori->where('kriteria_id', '=', $dataKriteria[$j]->id);
                    for ($k = 0; $k < count($data[$dataKriteria[$j]->nama]); $k++) {
                        if ($data[$dataKriteria[$j]->nama][$k] == null) {
                            $data[$dataKriteria[$j]->nama][$k] == null;
                        } else {
                            if ($data[$dataKriteria[$j]->nama][$k] < $min) {
                                $target = $dataKategori->whereIn('nama', $min)->first();
                                $data[$dataKriteria[$j]->nama][$k] = $target->bobot;
                            } elseif ($data[$dataKriteria[$j]->nama][$k] > $max) {
                                $target = $dataKategori->whereIn('nama', $max)->first();
                                $data[$dataKriteria[$j]->nama][$k] = $target->bobot;
                            } else {
                                $target = $dataKategori->whereBetween('nama', [$min + 1, $max - 1])->first();
                                $data[$dataKriteria[$j]->nama][$k] = $target->bobot;
                            }
                        }
                    }
                }
                $nilai = $data[$dataKriteria[$j]->nama];
                if (is_numeric($nilai[$i])) {
                    $pilihan[$i] += $nilai[$i];
                } else {
                    $pilihan[$i] = null;
                }
            }
            $pilihan[$i] += round($r->alternatif[$i], 4);
            $hasil[$i] = collect([
                'alternatif' => Alternatif::where('bobot', $r->alternatif[$i])->first(),
                'nilai' => $pilihan[$i],
                'harga' => $r->harga[$i]
            ]);
        }
        $sorted = collect($hasil);

        // dd($sorted->nilai);
        // dd($sorted->sortByDesc('nilai'));

        return view('peternak.sapi.hasil', [
            'title' => 'sapi',
            'subtitle' => '',
            'active' => 'sapi',
            'pilihan' => $sorted->sortByDesc('nilai'),
            'hasil' => $hasil,
            'inputAlt' => $data['alternatif'],
            'alternatif' => Alternatif::all(),
        ]);

        // dd($r->, $r);
    }

    // public function storeRekomendasi()
    // {
    //     # code...
    // }
}
