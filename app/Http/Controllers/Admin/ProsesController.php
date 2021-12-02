<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\spk;
use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\Kategori;
use App\Models\Kriteria;
use App\Models\PrioritasAlternatif;
use App\Models\Subkriteria;
use Illuminate\Http\Request;

class ProsesController extends Controller
{
    public function kriteria()
    {
        $spk = new spk;
        $data = Kriteria::all();
        $n = count(Kriteria::all());

        $matrik = array();
        $urut     = 0;

        for ($x = 0; $x <= ($n - 2); $x++) {
            for ($y = ($x + 1); $y <= ($n - 1); $y++) {
                $urut++;

                $pilih    = "pilih" . $urut;
                $bobot     = "bobot" . $urut;

                if ($_POST[$pilih] == 1) {
                    $matrik[$x][$y] = $_POST[$bobot];
                    $matrik[$y][$x] = 1 / $_POST[$bobot];
                } else {
                    $matrik[$x][$y] = 1 / $_POST[$bobot];
                    $matrik[$y][$x] = $_POST[$bobot];
                }
                $spk->inputDataPerbandinganKriteria($data[$x]->id, $data[$y]->id, $matrik[$x][$y]);
            }
        }

        // diagonal --> bernilai 1
        for ($i = 0; $i <= ($n - 1); $i++) {
            $matrik[$i][$i] = 1;
        }

        // inisialisasi jumlah tiap kolom dan baris kriteria
        $jmlmpb = array();
        $jmlmnk = array();
        $jmlmptk = array();
        $jmlmprkk = 0;
        $bobot = array();
        for ($i = 0; $i <= ($n - 1); $i++) {
            $jmlmpb[$i] = 0;
            $jmlmnk[$i] = 0;
            $jmlmptk[$i] = 0;
            $bobot[$i] = 0;
        }

        // menghitung jumlah pada kolom kriteria tabel perbandingan berpasangan
        for ($x = 0; $x <= ($n - 1); $x++) {
            for ($y = 0; $y <= ($n - 1); $y++) {
                $value        = $matrik[$x][$y];
                $jmlmpb[$y] += $value;
            }
        }

        // menghitung jumlah pada baris kriteria tabel nilai kriteria
        // matrikb merupakan matrik yang telah dinormalisasi
        for ($x = 0; $x <= ($n - 1); $x++) {
            for ($y = 0; $y <= ($n - 1); $y++) {
                $matrikb[$x][$y] = $matrik[$x][$y] / $jmlmpb[$y];
                $value    = $matrikb[$x][$y];
                $jmlmnk[$x] += $value;
            }
            // nilai priority vektor
            $pv[$x]     = $jmlmnk[$x] / $n;
        }

        // rumus = matrik perbandingan x nilai prioritas
        for ($x = 0; $x <= ($n - 1); $x++) {
            for ($y = 0; $y <= ($n - 1); $y++) {
                $matrikc[$x][$y] = $matrik[$x][$y] * $pv[$x];
                $value = $matrikc[$x][$y];
                $jmlmptk[$x] += $value;
            }
        }

        // menghitung hasil dari matrik perhitungan rasio konsistensi
        for ($x = 0; $x <= ($n - 1); $x++) {
            $hasiljp[$x] = $pv[$x] + $jmlmptk[$x];
            $value = $hasiljp[$x];
            $jmlmprkk += $value;
        }

        // mencari lamda, ci, cr
        $lamda = $spk->getLamda($jmlmprkk, $n);
        $ci = $spk->getCI($lamda, $n);
        $cr = $spk->getCR($ci, $n);

        // mencari  bobot setiap kriteria
        for ($x = 0; $x <= ($n - 1); $x++) {
            $bobot[$x] = $hasiljp[$x] / $jmlmprkk;
            $data[$x]->update([
                'bobot' => round($bobot[$x], 4)
            ]);
        }

        return view('admin.bobot.kriteria', [
            'title' => 'bobotkriteria',
            'subtitle' => '',
            'active' => 'bobot.kriteria',
            'data' => Kriteria::all(),
            'matrik' => $matrik,
            'jmlmpb' => $jmlmpb,
            'jmlmnk' => $jmlmnk,
            'matrikb' => $matrikb,
            'pv' => $pv,
            'matrikc' => $matrikc,
            'jmlmptk' => $jmlmptk,
            'hasiljp' => $hasiljp,
            'jmlmprkk' => $jmlmprkk,
            'lamda' => $lamda,
            'ci' => $ci,
            'cr' => $cr
        ]);
    }

    public function subkriteria($id)
    {
        $spk = new spk;
        $kriteria = Kriteria::findOrFail($id);
        $data = Subkriteria::where('kriteria_id', $id)->get();
        $n = count($data);

        $matrik = array();
        $urut     = 0;

        for ($x = 0; $x <= ($n - 2); $x++) {
            for ($y = ($x + 1); $y <= ($n - 1); $y++) {
                $urut++;

                $pilih    = "pilih" . $urut;
                $bobot     = "bobot" . $urut;

                if ($_POST[$pilih] == 1) {
                    $matrik[$x][$y] = $_POST[$bobot];
                    $matrik[$y][$x] = 1 / $_POST[$bobot];
                } else {
                    $matrik[$x][$y] = 1 / $_POST[$bobot];
                    $matrik[$y][$x] = $_POST[$bobot];
                }
                $spk->inputDataPerbandinganSubkriteria($data[$x]->id, $data[$y]->id, $matrik[$x][$y]);
            }
        }

        // diagonal --> bernilai 1
        for ($i = 0; $i <= ($n - 1); $i++) {
            $matrik[$i][$i] = 1;
        }

        // inisialisasi jumlah tiap kolom dan baris kriteria
        $jmlmpb = array();
        $jmlmnk = array();
        $jmlmptk = array();
        $jmlmprkk = 0;
        $bobot = array();
        for ($i = 0; $i <= ($n - 1); $i++) {
            $jmlmpb[$i] = 0;
            $jmlmnk[$i] = 0;
            $jmlmptk[$i] = 0;
            $bobot[$i] = 0;
        }

        // menghitung jumlah pada kolom kriteria tabel perbandingan berpasangan
        for ($x = 0; $x <= ($n - 1); $x++) {
            for ($y = 0; $y <= ($n - 1); $y++) {
                $value        = $matrik[$x][$y];
                $jmlmpb[$y] += $value;
            }
        }

        // menghitung jumlah pada baris kriteria tabel nilai kriteria
        // matrikb merupakan matrik yang telah dinormalisasi
        for ($x = 0; $x <= ($n - 1); $x++) {
            for ($y = 0; $y <= ($n - 1); $y++) {
                $matrikb[$x][$y] = $matrik[$x][$y] / $jmlmpb[$y];
                $value    = $matrikb[$x][$y];
                $jmlmnk[$x] += $value;
            }
            // nilai priority vektor
            $pv[$x]     = $jmlmnk[$x] / $n;
        }

        // rumus = matrik perbandingan x nilai prioritas
        for ($x = 0; $x <= ($n - 1); $x++) {
            for ($y = 0; $y <= ($n - 1); $y++) {
                $matrikc[$x][$y] = $matrik[$x][$y] * $pv[$x];
                // dd($matrikc[$x][$y]);
                $value = $matrikc[$x][$y];
                $jmlmptk[$x] += $value;
            }
        }

        // menghitung hasil dari matrik perhitungan rasio konsistensi
        for ($x = 0; $x <= ($n - 1); $x++) {
            $hasiljp[$x] = $pv[$x] + $jmlmptk[$x];
            $value = $hasiljp[$x];
            $jmlmprkk += $value;
        }

        // mencari lamda, ci, cr
        $lamda = $spk->getLamda($jmlmprkk, $n);
        $ci = $spk->getCI($lamda, $n);
        $cr = $spk->getCR($ci, $n);

        // mencari  bobot setiap kriteria
        for ($x = 0; $x <= ($n - 1); $x++) {
            $bobot[$x] = $hasiljp[$x] / $jmlmprkk;
            $data[$x]->update([
                'bobot' => round($kriteria->bobot * $bobot[$x], 4)
            ]);
        }

        return view('admin.bobot.subkriteria', [
            'title' => 'bobotsubkriteria',
            'subtitle' => '',
            'active' => 'kriteria',
            'kriteria' => Kriteria::findOrFail($id),
            'data' => Subkriteria::where('kriteria_id', $id)->get(),
            'matrik' => $matrik,
            'jmlmpb' => $jmlmpb,
            'jmlmnk' => $jmlmnk,
            'matrikb' => $matrikb,
            'pv' => $pv,
            'matrikc' => $matrikc,
            'jmlmptk' => $jmlmptk,
            'hasiljp' => $hasiljp,
            'jmlmprkk' => $jmlmprkk,
            'lamda' => $lamda,
            'ci' => $ci,
            'cr' => $cr
        ]);
    }

    public function kategoriKriteria($id)
    {
        // dd($id);
        $spk = new spk;
        $kriteria = Kriteria::findOrFail($id);
        $data = Kategori::where('kriteria_id', $id)->get();
        $n = count($data);
        // dd($data, $n, $kriteria);
        $matrik = array();
        $urut     = 0;

        for ($x = 0; $x <= ($n - 2); $x++) {
            for ($y = ($x + 1); $y <= ($n - 1); $y++) {
                $urut++;

                $pilih    = "pilih" . $urut;
                $bobot     = "bobot" . $urut;

                if ($_POST[$pilih] == 1) {
                    $matrik[$x][$y] = $_POST[$bobot];
                    $matrik[$y][$x] = 1 / $_POST[$bobot];
                } else {
                    $matrik[$x][$y] = 1 / $_POST[$bobot];
                    $matrik[$y][$x] = $_POST[$bobot];
                }
                $spk->inputDataPerbandinganKategoriKriteria($data[$x]->id, $data[$y]->id, $matrik[$x][$y], $kriteria->kode);
            }
        }

        // diagonal --> bernilai 1
        for ($i = 0; $i <= ($n - 1); $i++) {
            $matrik[$i][$i] = 1;
        }

        // inisialisasi jumlah tiap kolom dan baris kriteria
        $jmlmpb = array();
        $jmlmnk = array();
        $jmlmptk = array();
        $jmlmprkk = 0;
        $bobot = array();
        for ($i = 0; $i <= ($n - 1); $i++) {
            $jmlmpb[$i] = 0;
            $jmlmnk[$i] = 0;
            $jmlmptk[$i] = 0;
            $bobot[$i] = 0;
        }

        // menghitung jumlah pada kolom kriteria tabel perbandingan berpasangan
        for ($x = 0; $x <= ($n - 1); $x++) {
            for ($y = 0; $y <= ($n - 1); $y++) {
                $value        = $matrik[$x][$y];
                $jmlmpb[$y] += $value;
            }
        }

        // menghitung jumlah pada baris kriteria tabel nilai kriteria
        // matrikb merupakan matrik yang telah dinormalisasi
        for ($x = 0; $x <= ($n - 1); $x++) {
            for ($y = 0; $y <= ($n - 1); $y++) {
                $matrikb[$x][$y] = $matrik[$x][$y] / $jmlmpb[$y];
                $value    = $matrikb[$x][$y];
                $jmlmnk[$x] += $value;
            }
            // nilai priority vektor
            $pv[$x]     = $jmlmnk[$x] / $n;
        }

        // rumus = matrik perbandingan x nilai prioritas
        for ($x = 0; $x <= ($n - 1); $x++) {
            for ($y = 0; $y <= ($n - 1); $y++) {
                $matrikc[$x][$y] = $matrik[$x][$y] * $pv[$x];
                // dd($matrikc[$x][$y]);
                $value = $matrikc[$x][$y];
                $jmlmptk[$x] += $value;
            }
        }

        // menghitung hasil dari matrik perhitungan rasio konsistensi
        for ($x = 0; $x <= ($n - 1); $x++) {
            $hasiljp[$x] = $pv[$x] + $jmlmptk[$x];
            $value = $hasiljp[$x];
            $jmlmprkk += $value;
        }

        // mencari lamda, ci, cr
        $lamda = $spk->getLamda($jmlmprkk, $n);
        $ci = $spk->getCI($lamda, $n);
        $cr = $spk->getCR($ci, $n);

        // dd($data);

        // mencari  bobot setiap kriteria
        for ($x = 0; $x <= ($n - 1); $x++) {
            $val = $hasiljp[$x] / $jmlmprkk;
            $bobot[$x] = $val * $kriteria->bobot;
            // dd($val, $bobot[$x]);
            $data[$x]->update([
                'bobot' => round($bobot[$x], 4)
            ]);
        }

        return view('admin.bobot.kategori.kriteria', [
            'title' => 'bobotkategorikriteria',
            'subtitle' => '',
            'active' => 'kriteria',
            'kriteria' => $kriteria,
            'data' => Kategori::where('kriteria_id', $id)->get(),
            'matrik' => $matrik,
            'jmlmpb' => $jmlmpb,
            'jmlmnk' => $jmlmnk,
            'matrikb' => $matrikb,
            'pv' => $pv,
            'matrikc' => $matrikc,
            'jmlmptk' => $jmlmptk,
            'hasiljp' => $hasiljp,
            'jmlmprkk' => $jmlmprkk,
            'lamda' => $lamda,
            'ci' => $ci,
            'cr' => $cr
        ]);
    }

    public function kategoriSubkriteria($id)
    {
        // dd($id);
        $spk = new spk;
        $subkriteria = Subkriteria::findOrFail($id);
        $data = Kategori::where('subkriteria_id', $id)->get();
        $n = count($data);

        // dd($data);

        $matrik = array();
        $urut     = 0;

        for ($x = 0; $x <= ($n - 2); $x++) {
            for ($y = ($x + 1); $y <= ($n - 1); $y++) {
                $urut++;

                $pilih    = "pilih" . $urut;
                $bobot     = "bobot" . $urut;

                if ($_POST[$pilih] == 1) {
                    $matrik[$x][$y] = $_POST[$bobot];
                    $matrik[$y][$x] = 1 / $_POST[$bobot];
                } else {
                    $matrik[$x][$y] = 1 / $_POST[$bobot];
                    $matrik[$y][$x] = $_POST[$bobot];
                }
                $spk->inputDataPerbandinganKategoriSubkriteria($data[$x]->id, $data[$y]->id, $matrik[$x][$y], $subkriteria->kode);
            }
        }

        // diagonal --> bernilai 1
        for ($i = 0; $i <= ($n - 1); $i++) {
            $matrik[$i][$i] = 1;
        }

        // inisialisasi jumlah tiap kolom dan baris kriteria
        $jmlmpb = array();
        $jmlmnk = array();
        $jmlmptk = array();
        $jmlmprkk = 0;
        $bobot = array();
        for ($i = 0; $i <= ($n - 1); $i++) {
            $jmlmpb[$i] = 0;
            $jmlmnk[$i] = 0;
            $jmlmptk[$i] = 0;
            $bobot[$i] = 0;
        }

        // menghitung jumlah pada kolom kriteria tabel perbandingan berpasangan
        for ($x = 0; $x <= ($n - 1); $x++) {
            for ($y = 0; $y <= ($n - 1); $y++) {
                $value        = $matrik[$x][$y];
                $jmlmpb[$y] += $value;
            }
        }

        // menghitung jumlah pada baris kriteria tabel nilai kriteria
        // matrikb merupakan matrik yang telah dinormalisasi
        for ($x = 0; $x <= ($n - 1); $x++) {
            for ($y = 0; $y <= ($n - 1); $y++) {
                $matrikb[$x][$y] = $matrik[$x][$y] / $jmlmpb[$y];
                $value    = $matrikb[$x][$y];
                $jmlmnk[$x] += $value;
            }
            // nilai priority vektor
            $pv[$x]     = $jmlmnk[$x] / $n;
        }

        // rumus = matrik perbandingan x nilai prioritas
        for ($x = 0; $x <= ($n - 1); $x++) {
            for ($y = 0; $y <= ($n - 1); $y++) {
                $matrikc[$x][$y] = $matrik[$x][$y] * $pv[$x];
                // dd($matrikc[$x][$y]);
                $value = $matrikc[$x][$y];
                $jmlmptk[$x] += $value;
            }
        }

        // menghitung hasil dari matrik perhitungan rasio konsistensi
        for ($x = 0; $x <= ($n - 1); $x++) {
            $hasiljp[$x] = $pv[$x] + $jmlmptk[$x];
            $value = $hasiljp[$x];
            $jmlmprkk += $value;
        }

        // mencari lamda, ci, cr
        $lamda = $spk->getLamda($jmlmprkk, $n);
        $ci = $spk->getCI($lamda, $n);
        $cr = $spk->getCR($ci, $n);

        // dd($subkriteria);
        // $val = $hasiljp[$x] / $jmlmprkk;
        // $bobot[$x] = $val * $kriteria->bobot;

        // mencari  bobot setiap kriteria
        for ($x = 0; $x <= ($n - 1); $x++) {
            $val = $hasiljp[$x] / $jmlmprkk;
            $bobot[$x] = $val * $subkriteria->bobot;
            $data[$x]->update([
                'bobot' => round($bobot[$x], 4)
            ]);
        }

        return view('admin.bobot.kategori.subkriteria', [
            'title' => 'bobotkategorikriteria',
            'subtitle' => '',
            'active' => 'kriteria',
            'subkriteria' => $subkriteria,
            'data' => Kategori::where('subkriteria_id', $id)->get(),
            'matrik' => $matrik,
            'jmlmpb' => $jmlmpb,
            'jmlmnk' => $jmlmnk,
            'matrikb' => $matrikb,
            'pv' => $pv,
            'matrikc' => $matrikc,
            'jmlmptk' => $jmlmptk,
            'hasiljp' => $hasiljp,
            'jmlmprkk' => $jmlmprkk,
            'lamda' => $lamda,
            'ci' => $ci,
            'cr' => $cr
        ]);
    }

    public function alternatif($kode)
    {

        $spk = new spk;
        $kriteria = $spk->getDataAllKriteria();
        $data = Alternatif::all();
        $n = count($data);

        $dataKriteria = $kriteria[$kode];

        $matrik = array();
        $urut     = 0;


        for ($x = 0; $x <= ($n - 2); $x++) {
            for ($y = ($x + 1); $y <= ($n - 1); $y++) {
                $urut++;

                $pilih    = "pilih" . $urut;
                $bobot     = "bobot" . $urut;

                if ($_POST[$pilih] == 1) {
                    $matrik[$x][$y] = $_POST[$bobot];
                    $matrik[$y][$x] = 1 / $_POST[$bobot];
                } else {
                    $matrik[$x][$y] = 1 / $_POST[$bobot];
                    $matrik[$y][$x] = $_POST[$bobot];
                }
                $spk->InputDataPerbandinganAlternatif($data[$x]->id, $data[$y]->id, $dataKriteria->kode, $matrik[$x][$y]);
            }
        }

        // diagonal --> bernilai 1
        for ($i = 0; $i <= ($n - 1); $i++) {
            $matrik[$i][$i] = 1;
        }

        // inisialisasi jumlah tiap kolom dan baris kriteria
        $jmlmpb = array();
        $jmlmnk = array();
        $jmlmptk = array();
        $jmlmprkk = 0;
        $bobot = array();
        for ($i = 0; $i <= ($n - 1); $i++) {
            $jmlmpb[$i] = 0;
            $jmlmnk[$i] = 0;
            $jmlmptk[$i] = 0;
            $bobot[$i] = 0;
        }

        // menghitung jumlah pada kolom kriteria tabel perbandingan berpasangan
        for ($x = 0; $x <= ($n - 1); $x++) {
            for ($y = 0; $y <= ($n - 1); $y++) {
                $value        = $matrik[$x][$y];
                $jmlmpb[$y] += $value;
            }
        }

        // menghitung jumlah pada baris kriteria tabel nilai kriteria
        // matrikb merupakan matrik yang telah dinormalisasi
        for ($x = 0; $x <= ($n - 1); $x++) {
            for ($y = 0; $y <= ($n - 1); $y++) {
                $matrikb[$x][$y] = $matrik[$x][$y] / $jmlmpb[$y];
                $value    = $matrikb[$x][$y];
                $jmlmnk[$x] += $value;
            }
            // nilai priority vektor
            $pv[$x]     = $jmlmnk[$x] / $n;
        }

        // rumus = matrik perbandingan x nilai prioritas
        for ($x = 0; $x <= ($n - 1); $x++) {
            for ($y = 0; $y <= ($n - 1); $y++) {
                $matrikc[$x][$y] = $matrik[$x][$y] * $pv[$x];
                $value = $matrikc[$x][$y];
                $jmlmptk[$x] += $value;
            }
        }

        // menghitung hasil dari matrik perhitungan rasio konsistensi
        for ($x = 0; $x <= ($n - 1); $x++) {
            $hasiljp[$x] = $pv[$x] + $jmlmptk[$x];
            $value = $hasiljp[$x];
            $jmlmprkk += $value;
        }

        // mencari lamda, ci, cr
        $lamda = $spk->getLamda($jmlmprkk, $n);
        $ci = $spk->getCI($lamda, $n);
        $cr = $spk->getCR($ci, $n);

        // mencari  bobot setiap alternatif
        for ($x = 0; $x <= ($n - 1); $x++) {
            $bobot[$x] = $hasiljp[$x] / $jmlmprkk;
            PrioritasAlternatif::updateOrCreate([
                'kode_alt' => $data[$x]->kode,
                'kode_kri' => $dataKriteria->kode,
                'nilai' => round($bobot[$x], 4)
            ]);
        }

        return view('admin.bobot.alternatif', [
            'title' => 'bobotalternatif',
            'subtitle' => '',
            'active' => 'alternatif',
            'data' => Alternatif::all(),
            'dataKriteria' => $dataKriteria = $kriteria[$kode],
            'kode' => $kode,
            'matrik' => $matrik,
            'jmlmpb' => $jmlmpb,
            'jmlmnk' => $jmlmnk,
            'matrikb' => $matrikb,
            'pv' => $pv,
            'matrikc' => $matrikc,
            'jmlmptk' => $jmlmptk,
            'hasiljp' => $hasiljp,
            'jmlmprkk' => $jmlmprkk,
            'lamda' => $lamda,
            'ci' => $ci,
            'cr' => $cr
        ]);
    }
}
