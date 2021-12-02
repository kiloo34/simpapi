@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ucfirst($title)}} {{__('Kriteria')}} {{$kriteria->nama}}</h4>
            </div>
            <div class="card-body">
                <a href="{{ route('kategorikriteria.index', $kriteria->id) }}" class="btn btn-sm btn-danger mb-3"
                    role="button">
                    <i class="fa fa-arrow-left"></i>
                    {{__('Kembali')}}
                </a>
                <form action="{{ route('bobotkategorikriteria.index', $kriteria->id) }}" method="post">
                    @csrf
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th colspan="2">pilih yang lebih penting</th>
                                <th>nilai perbandingan</th>
                            </tr>
                        </thead>
                        <?php
                    $urut = 0;
                    $n = count($data);
                    for ($x = 0; $x <= ($n - 2); $x++) {
                        for ($y = ($x + 1); $y <= ($n - 1); $y++) {
                        $urut++;
                        // dd($data[$x]->nama, $data[$y]->nama);
                    ?>
                        <tr>
                            <td>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input name="pilih{{$urut}}" value="1" checked="" class="hidden" type="radio">
                                        <label>{{$data[$x]->nama}}</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input name="pilih{{$urut}}" value="2" class="hidden" type="radio">
                                        <label>{{$data[$y]->nama}}</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="field">
                                    @php
                                    $nilai = $spk->getNilaiPerbandinganKategoriKriteria($data[$x]->id, $data[$y]->id);
                                    @endphp
                                    <input type="text" name="bobot{{$urut}}"
                                        value="{{$nilai == null ? null : round($nilai[0]->nilai, 4)}}" required>
                                </div>
                            </td>
                        </tr>
                        <?php
                        }
                    }
                ?>
                    </table>
                    @if ($nilai==null)
                    <input type="submit" class="btn btn-success float-right" value="Submit">
                    @else
                    <input type="submit" class="btn btn-success float-right" value="Ubah">
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dt').DataTable();
    });
</script>
@endpush
@endsection
@include('import.datatable')
