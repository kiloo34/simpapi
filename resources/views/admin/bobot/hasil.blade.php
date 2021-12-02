@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Hasil Perhitungan {{ucfirst($title)}}</h4>
            </div>
            <div class="card-body">
                {{-- <a href="{{ route('alternatif.index') }}" class="btn btn-sm btn-danger mb-3" role="button">
                <i class="fa fa-arrow-left"></i>
                {{__('Kembali')}}
                </a> --}}
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Overall Composite Height</th>
                                <th>Priority Vector (rata-rata)</th>
                                <?php for ($i = 0; $i < count($alternatif); $i++) { ?>
                                <th>{{$alternatif[$i]->nama}}</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($nilai) > 0)
                            <?php for ($i=0; $i < count($kriteria); $i++) { ?>
                            <tr>
                                <td>{{$kriteria[$i]->nama}}</td>
                                <td>{{round($kriteria[$i]->bobot, 4)}}</td>
                                <?php for ($j=0; $j < count($alternatif); $j++) {
                                    $data = $spk->getBobotAlternatif($alternatif[$j]->kode, $kriteria[$i]->kode)
                                ?>
                                {{-- {{dd($kriteria[$i]->kode, $alternatif[$j]->kode, $nilai)}} --}}
                                <td>{{round($data->nilai, 4)}}</td>
                                <?php } ?>
                            </tr>
                            <?php } ?>
                            @else
                            <tr>
                                <td colspan="2{{+count($alternatif)}}" class="text-center">Tidak ada Data silakan tambah
                                    nilai perbandingan alternatif</td>
                            </tr>
                            @endif
                        </tbody>
                        @if (count($nilai) > 0)
                        <tfoot>
                            <tr>
                                <th colspan="2"><b>Total</b></th>
                                <?php for ($i=0; $i < count($alternatif); $i++) { ?>
                                <th>{{round($nilai[$i], 4)}}</th>
                                <?php } ?>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@if (count($nilai) > 0)
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Rangking alternatif</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Peringkat</th>
                                <th>Alternatif</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1 ?>
                            @foreach ($alternatif as $a)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$a->nama}}</td>
                                <td>{{$a->bobot}}</td>
                                <?php $no++ ?>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@include('import.datatable')
