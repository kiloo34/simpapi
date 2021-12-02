<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\spk;
use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Http\Request;

class SubkriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // dd($id);
        return view('admin.subkriteria.index', [
            'title' => 'subkriteria',
            'subtitle' => '',
            'active' => 'subkriteria',
            'data' => Subkriteria::where('kriteria_id', $id)->get(),
            'kriteria' => Kriteria::findOrFail($id)
        ]);
    }

    public function kembali()
    {
        return redirect()->route('kriteria.index');
    }

    public function nilai($id)
    {
        $data = Subkriteria::where('kriteria_id', $id)->get();
        $kriteria = Kriteria::findOrFail($id);

        return view('admin.subkriteria.nilai', [
            'title' => 'nilaisubkriteria',
            'subtitle' => '',
            'active' => 'subkriteria',
            'data' => $data,
            'kriteria' => $kriteria,
            'spk' => new spk
        ]);
    }

    // public function submit($id)
    // {
    //     $spk = new spk;
    //     $data = Subkriteria::where('kriteria_id', $id);
    //     $n = count($data);
    //     // dd($data, $n);
    //     $matrik = array();
    //     $urut     = 0;

    //     for ($x = 0; $x <= ($n - 2); $x++) {
    //         for ($y = ($x + 1); $y <= ($n - 1); $y++) {
    //             $urut++;

    //             $pilih    = "pilih" . $urut;
    //             $bobot     = "bobot" . $urut;

    //             if ($_POST[$pilih] == 1) {
    //                 $matrik[$x][$y] = $_POST[$bobot];
    //                 $matrik[$y][$x] = 1 / $_POST[$bobot];
    //             } else {
    //                 $matrik[$x][$y] = 1 / $_POST[$bobot];
    //                 $matrik[$y][$x] = $_POST[$bobot];
    //             }
    //             $spk->inputDataPerbandinganKriteria($data[$x]->id, $data[$y]->id, $matrik[$x][$y]);
    //         }
    //     }

    //     // return redirect()->route('kriteria.index')->with('success_msg', 'Nilai Perbandingan berhasil diinput silakan lihat perhitungan kriteria');
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('admin.subkriteria.tambah', [
            'title' => 'subkriteria',
            'subtitle' => 'create',
            'active' => 'subkriteria',
            'kriteria' => Kriteria::findOrFail($id)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required|unique:kriteria,kode|unique:Subkriteria,kode',
            'nama' => 'required'
        ], [
            'kode.required' => 'Kode harap diisi',
            'kode.unique' => 'This kode sudah ditambahkan di kriteria / subkriteria',
            'nama.required' => 'nama harap diisi'
        ]);
        $data = Subkriteria::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'kriteria_id' => $id
        ]);
        return redirect()->route('subkriteria.index', $id)->with('success_msg', 'kriteria ' . $data->nama . ' berhasil ditambah');
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
    public function edit($id, $subkriteriaId)
    {
        return view('admin.subkriteria.ubah', [
            'title' => 'subkriteria',
            'subtitle' => 'update',
            'active' => 'subkriteria',
            'kriteria' => Kriteria::findOrFail($id),
            'subkriteria' => Subkriteria::findOrFail($subkriteriaId)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $subkriteriaId)
    {
        $kriteria = Kriteria::findOrFail($id);
        $data = Subkriteria::findOrFail($subkriteriaId);
        $request->validate([
            'kode' => 'required|unique:subkriteria,kode,' . $data->id,
            'nama' => 'required'
        ], [
            'kode.required' => 'Kode harap diisi',
            'kode.unique' => 'kode sudah ditambahkan di kriteria',
            'nama.required' => 'nama harap diisi'
        ]);
        $data->update([
            'kode' => $request->kode,
            'nama' => $request->nama
        ]);
        return redirect()->route('subkriteria.index', $id)->with('success_msg', 'Subkriteria ' . $data->nama . ' dari Kriteria ' . $kriteria->nama . ' berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $subkriteriaId)
    {
        $target = Subkriteria::findOrFail($subkriteriaId);
        $target->delete();
        $kriteria = Kriteria::findOrFail($id);
        return response()->json([
            'message' => 'Subkriteria ' . $target->nama . ' dari Kriteria ' . $kriteria->nama . ' berhasil dihapus!'
        ]);
    }
}
