<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\spk;
use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\PrioritasAlternatif;
use App\Models\Subkriteria;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spk = new spk;
        $kriteria = $spk->getDataAllKriteria();

        // dd($kriteria);

        return view('admin.alternatif.index', [
            'title' => 'alternatif',
            'subtitle' => '',
            'active' => 'alternatif',
            'data' => Alternatif::all(),
            'kriteria' => $kriteria
        ]);
    }

    public function nilai($kode)
    {
        $spk = new spk;
        $kriteria = $spk->getDataAllKriteria();
        $jumlah = count($kriteria);
        // dd($kode, $jumlah);
        if ($kode >= $jumlah) {
            return redirect()->route('hasilalternatif.index')->with('success_msg', 'data sudah selesai dibandingkan, data perbandingan alternatif di tampilkan di bawah ini ');
        }
        $dataKriteria = $kriteria[$kode];
        // dd($kode);

        // dd($jumlah, $kode);
        // dd($kriteria);

        return view('admin.alternatif.nilai', [
            'title' => 'nilaialternatif',
            'subtitle' => '',
            'active' => 'alternatif',
            'data' => Alternatif::all(),
            'kriteria' => $kriteria,
            'dataKriteria' => $dataKriteria,
            'kode' => $kode,
            'spk' => $spk
        ]);
    }

    public function hasil()
    {
        $spk = new spk();
        $alternatif = Alternatif::all();
        $kriteria = $spk->getDataAllKriteria();
        $nilai = PrioritasAlternatif::all();

        // dd($nilai);

        if ($nilai->isEmpty()) {
            return view('admin.bobot.hasil', [
                'title' => 'hasilalternatif',
                'subtitle' => '',
                'active' => 'hasil',
                'kriteria' => $kriteria,
                'alternatif' => $alternatif->sortByDesc('bobot'),
                'nilai' => $nilai,
                'spk' => $spk
            ]);
        } else {
            $nilai = array();

            for ($i = 0; $i < count($alternatif); $i++) {
                $nilai[$i] = 0;
                for ($j = 0; $j < count($kriteria); $j++) {
                    $data = $spk->getBobotAlternatif($alternatif[$i]->kode, $kriteria[$j]->kode);
                    $nilai[$i] += ($data->nilai * $kriteria[$j]->bobot);
                }
                $alternatif[$i]->update([
                    'bobot' => $nilai[$i]
                ]);
            }

            return view('admin.bobot.hasil', [
                'title' => 'hasilalternatif',
                'subtitle' => '',
                'active' => 'hasil',
                'kriteria' => $kriteria,
                'alternatif' => $alternatif->sortByDesc('bobot'),
                'nilai' => $nilai,
                'spk' => $spk
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.alternatif.tambah', [
            'title' => 'alternatif',
            'subtitle' => 'create',
            'active' => 'alternatif',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd('masuk pak eko');
        $request->validate([
            'kode' => 'required|unique:alternatif,kode',
            'nama' => 'required'
        ]);

        $data = Alternatif::create([
            'kode' => $request->kode,
            'nama' => $request->nama
        ]);

        return redirect()->route('alternatif.index')->with('success_msg', 'alternatif ' . $data->nama . ' berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.alternatif.ubah', [
            'title' => 'alternatif',
            'subtitle' => 'update',
            'active' => 'alternatif',
            'alternatif' => Alternatif::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Alternatif::findOrFail($id);
        $request->validate([
            'kode' => 'required|unique:alternatif,kode,' . $data->id,
            'nama' => 'required'
        ]);
        $data->update([
            'kode' => $request->kode,
            'nama' => $request->nama
        ]);
        return redirect()->route('alternatif.index')->with('success_msg', 'alternatif ' . $data->nama . ' berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $target = Alternatif::findOrFail($id);
        $target->delete();
        return response()->json([
            'message' => 'Alternatif ' . $target->nama . ' berhasil dihapus!'
        ]);
    }
}
