@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Tabel Perbandingan {{ucfirst($title)}}</h4>
            </div>
            <div class="card-body">
                <a href="{{ route('nilaikriteria.create') }}" class="btn btn-sm btn-danger mb-3" role="button">
                    <i class="fa fa-arrow-left"></i>
                    {{__('Kembali')}}
                </a>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>kriteria</th>
                                <?php for ($i=0; $i < count($data); $i++) { ?>
                                <th>{{$data[$i]->nama}}</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i=0; $i < count($data); $i++) { ?>
                            <tr>
                                <td>{{$data[$i]->nama}}</td>
                                <?php for ($j=0; $j < count($data) ; $j++) { ?>
                                <td>{{round($matrik[$i][$j], 4)}}</td>
                                <?php } ?>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Jumlah</th>
                                <?php for ($i=0; $i < count($data); $i++) { ?>
                                <th>{{round($jmlmpb[$i], 4)}}</th>
                                <?php } ?>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Prioritas {{ucfirst($title)}}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>kriteria</th>
                                <?php for ($i=0; $i < count($data); $i++) { ?>
                                <th>{{$data[$i]->nama}}</th>
                                <?php } ?>
                                <th>Jumlah</th>
                                <th>Prioritas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i=0; $i < count($data); $i++) { ?>
                            <tr>
                                <td>{{$data[$i]->nama}}</td>
                                <?php for ($j=0; $j < count($data) ; $j++) { ?>
                                <td>{{round($matrikb[$i][$j], 4)}}</td>
                                <?php } ?>
                                <td>{{round($jmlmnk[$i], 4)}}</td>
                                <td>{{round($pv[$i], 4)}}</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Penjumlahan Tiap Baris {{ucfirst($title)}}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>kriteria</th>
                                <?php for ($i=0; $i < count($data); $i++) { ?>
                                <th>{{$data[$i]->nama}}</th>
                                <?php } ?>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i=0; $i < count($data); $i++) { ?>
                            <tr>
                                <td>{{$data[$i]->nama}}</td>
                                <?php for ($j=0; $j < count($data) ; $j++) { ?>
                                <td>{{round($matrikc[$i][$j], 4)}}</td>
                                <?php } ?>
                                <td>{{round($jmlmptk[$i], 4)}}</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Matrik Perhitungan Rasio Konsistensi {{ucfirst($title)}}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Kriteria</th>
                                <th>Jumlah</th>
                                <th>Prioritas</th>
                                <th>Hasil</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i=0; $i < count($data); $i++) { ?>
                            <tr>
                                <td>{{$data[$i]->nama}}</td>
                                <td>{{round($jmlmptk[$i], 4)}}</td>
                                <td>{{round($pv[$i], 4)}}</td>
                                <td>{{round($hasiljp[$i], 4)}}</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3">Jumlah</th>
                                <th>{{round($jmlmprkk, 4)}}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Cek Konsistensi {{ucfirst($title)}}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th colspan="2">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Lamda max</td>
                                <td colspan="2">{{round($lamda, 4)}}</td>
                            </tr>
                            <tr>
                                <td>CI</td>
                                <td colspan="2">{{round($ci, 4)}}</td>
                            </tr>
                            <tr>
                                <td>CR</td>
                                <td>{{round($cr, 4)}}</td>
                                <td>{{$cr < 0.1 ? 'Konsisten' : 'Tidak Konsisten'}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@include('import.datatable')
