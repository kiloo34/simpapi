<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\spk;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $kategori = Kategori::all();
        // dd($kategori);
        return view('admin.kriteria.index', [
            'title' => 'kriteria',
            'subtitle' => '',
            'active' => 'kriteria',
            'data' => Kriteria::all(),
            'sub' => Subkriteria::all(),
            'kategori'  => Kategori::all()
        ]);
    }

    public function nilai()
    {
        return view('admin.kriteria.nilai', [
            'title' => 'nilaikriteria',
            'subtitle' => '',
            'active' => 'kriteria',
            'data' => Kriteria::all(),
            'spk' => new spk
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kriteria.tambah', [
            'title' => 'kriteria',
            'subtitle' => 'create',
            'active' => 'kriteria',
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
        $request->validate([
            'kode' => 'required|unique:kriteria,kode|unique:Subkriteria,kode',
            'nama' => 'required'
        ], [
            'kode.required' => 'Kode harap diisi',
            'kode.unique' => 'This kode sudah ditambahkan di kriteria / subkriteria',
            'nama.required' => 'nama harap diisi'
        ]);

        $data = Kriteria::create([
            'kode' => $request->kode,
            'nama' => $request->nama
        ]);
        return redirect()->route('kriteria.index')->with('success_msg', 'kriteria ' . $data->nama . ' berhasil ditambah');
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
        return view('admin.kriteria.ubah', [
            'title' => 'kriteria',
            'subtitle' => 'update',
            'active' => 'kriteria',
            'kriteria' => Kriteria::findOrFail($id)
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
        $data = Kriteria::findOrFail($id);
        $request->validate([
            'kode' => 'required|unique:kriteria,kode,' . $data->id,
            'nama' => 'required'
        ]);
        $data->update([
            'kode' => $request->kode,
            'nama' => $request->nama
        ]);
        return redirect()->route('kriteria.index')->with('success_msg', 'kriteria ' . $data->nama . ' berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $target = Kriteria::findOrFail($id);
        $target->delete();
        return response()->json([
            'message' => 'Kriteria ' . $target->nama . ' berhasil dihapus!'
        ]);
    }
}
