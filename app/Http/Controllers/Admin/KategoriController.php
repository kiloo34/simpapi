<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\spk;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function kriteria($id)
    {
        return view('admin.kategori.kriteria.index', [
            'title' => 'kategorikriteria',
            'subtitle' => '',
            'active' => 'kriteria',
            'kriteria' => Kriteria::findOrFail($id),
            'data' => Kategori::where('kriteria_id', $id)->get()
        ]);
    }

    public function kriteriaCreate($id)
    {
        return view('admin.kategori.kriteria.tambah', [
            'title' => 'kategorikriteria',
            'subtitle' => 'create',
            'active' => 'kriteria',
            'kriteria' => Kriteria::findOrFail($id),
        ]);
    }

    public function kriteriaStore(Request $request, $id)
    {
        $kriteria = Kriteria::findOrFail($id);
        if ($kriteria->nama == 'harga') {
            $request->validate([
                'nama'              => 'required|numeric'
            ], [
                'nama.required' => 'kategori harap diisi',
                'nama.numeric' => 'kategori harus berupa angka'
            ]);
        } else {
            $request->validate([
                'nama'              => 'required'
            ], ['nama.required' => 'nama kategori harap diisi']);
        }
        Kategori::create([
            'nama' => $request->nama,
            'kriteria_id' => $kriteria->id,
        ]);

        return redirect()->route('kategorikriteria.index', $id)->with('success_msg', 'Kategori ' . $request->nama . ' telah ditambah ke Kriteria ' . $kriteria->nama);
    }

    public function kriteriaEdit($id, $kategoriId)
    {
        return view('admin.kategori.kriteria.ubah', [
            'title' => 'kategorikriteria',
            'subtitle' => 'edit',
            'active' => 'kriteria',
            'kriteria' => Kriteria::findOrFail($id),
            'kategori' => Kategori::findOrFail($kategoriId)
        ]);
    }

    public function kriteriaUpdate(Request $request, $id, $kategoriId)
    {
        $kriteria = Kriteria::findOrFail($id);
        if ($kriteria->nama == 'harga') {
            $request->validate([
                'nama'              => 'required|numeric'
            ], [
                'nama.required' => 'kategori harap diisi',
                'nama.numeric' => 'kategori harus berupa angka'
            ]);
        } else {
            $request->validate([
                'nama'              => 'required'
            ], [
                'nama.required' => 'nama kategori harap diisi'
            ]);
        }
        $data = Kategori::findOrFail($kategoriId);
        $data->update([
            'nama' => $request->nama,
            'kriteria_id' => $id
        ]);

        return redirect()->route('kategorikriteria.index', $id)->with('success_msg', 'Kategori ' . $request->nama . ' telah diubah');
    }

    public function kriteriaDestroy($id, $kategoriId)
    {
        $target = Kategori::findOrFail($kategoriId);
        $target->delete();
        $kriteria = Kriteria::findOrFail($id);
        return response()->json([
            'message' => 'Kategori ' . $target->nama . ' dari Kriteria ' . $kriteria->nama . ' berhasil dihapus!'
        ]);
    }

    public function nilaiKategoriKriteria($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $data = Kategori::where('kriteria_id', $id)->get();

        return view('admin.kategori.kriteria.nilai', [
            'title' => 'nilaikategori',
            'subtitle' => '',
            'active' => 'kriteria',
            'kriteria' => Kriteria::findOrFail($id),
            'data' => Kategori::where('kriteria_id', $id)->get(),
            'spk' => new spk
        ]);
    }

    public function subkriteria($id)
    {
        return view('admin.kategori.subkriteria.index', [
            'title' => 'kategorisubkriteria',
            'subtitle' => '',
            'active' => 'kriteria',
            'subkriteria' => Subkriteria::findOrFail($id),
            'data' => Kategori::where('subkriteria_id', $id)->get()
        ]);
    }

    public function subkriteriaCreate($id)
    {
        return view('admin.kategori.subkriteria.tambah', [
            'title' => 'kategorisubkriteria',
            'subtitle' => 'create',
            'active' => 'kriteria',
            'subkriteria' => Subkriteria::findOrFail($id)
        ]);
    }

    public function subkriteriaStore(Request $request, $id)
    {
        $subkriteria = Subkriteria::findOrFail($id);
        if ($subkriteria->nama == 'harga') {
            $request->validate([
                'nama'              => 'required|numeric'
            ]);
        } else {
            $request->validate([
                'nama'              => 'required'
            ]);
        }
        Kategori::create([
            'nama' => $request->nama,
            'subkriteria_id' => $subkriteria->id,
        ]);

        return redirect()->route('kategorisubkriteria.index', $id)->with('success_msg', 'Kategori ' . $request->nama . ' telah ditambah ke Kriteria ' . $subkriteria->nama);
    }

    public function subkriteriaEdit($id, $kategoriId)
    {
        return view('admin.kategori.subkriteria.ubah', [
            'title' => 'kategorikriteria',
            'subtitle' => 'edit',
            'active' => 'kriteria',
            'subkriteria' => Subkriteria::findOrFail($id),
            'kategori' => Kategori::findOrFail($kategoriId)
        ]);
    }

    public function subkriteriaUpdate(Request $request, $id, $kategoriId)
    {
        $kriteria = Subkriteria::findOrFail($id);
        if ($kriteria->nama == 'harga') {
            $request->validate([
                'nama'              => 'required|numeric'
            ], [
                'nama.required' => 'kategori harap diisi',
                'nama.numeric' => 'kategori harus berupa angka'
            ]);
        } else {
            $request->validate([
                'nama'              => 'required'
            ], [
                'nama.required' => 'nama kategori harap diisi'
            ]);
        }
        $data = Kategori::findOrFail($kategoriId);
        $data->update([
            'nama' => $request->nama,
            'kriteria_id' => $id
        ]);

        return redirect()->route('kategorisubkriteria.index', $id)->with('success_msg', 'Kategori ' . $request->nama . ' telah diubah');
    }

    public function subkriteriaDestroy($id, $kategoriId)
    {
        $target = Kategori::findOrFail($kategoriId);
        $target->delete();
        $subkriteria = Subkriteria::findOrFail($id);
        return response()->json([
            'message' => 'Kategori ' . $target->nama . ' dari Subkriteria ' . $subkriteria->nama . ' berhasil dihapus!'
        ]);
    }

    public function nilaiKategoriSubkriteria($id)
    {
        // dd('masuk');
        return view('admin.kategori.subkriteria.nilai', [
            'title' => 'nilaikategori',
            'subtitle' => '',
            'active' => 'kriteria',
            'subkriteria' => Subkriteria::findOrFail($id),
            'data' => Kategori::where('subkriteria_id', $id)->get(),
            'spk' => new spk
        ]);
    }
}
