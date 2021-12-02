@extends('layouts.myview')
@section('content')
{{-- {{dd($kriteria)}} --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Tambah {{ucfirst($title)}} dengan Rekomendasi</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('hitung.index') }}" method="post">
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-bordered table-md">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Sapi</th>
                                    @foreach ($kriteria as $k)
                                    <th>{{ucfirst($k->nama)}}</th>
                                    @endforeach
                                    {{-- <th>Aksi</th> --}}
                                </tr>
                            </thead>
                            @foreach (range(0, $jumlah - 1) as $x)
                            <tr>
                                <td>{{$x+1}}</td>
                                <td style="min-width:200px">
                                    <div class="form-group">
                                        <select name="alternatif[{{$x}}]" class="custom-select" id="inputGroupSelect01"
                                            required>
                                            <option value="" selected>Pilih Data</option>
                                            @foreach ($alternatif as $alt)
                                            <option value="{{$alt->bobot}}">{{$alt->nama}}</option>
                                            @endforeach
                                        </select>
                                        @error('alternatif[{{$x}}]')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </td>
                                @foreach ($kriteria as $k)
                                @php
                                $cek = $spk->cekKriteria($k);
                                @endphp
                                <td style="min-width:200px">
                                    <div class="form-group">
                                        @if ($k->nama == 'harga')
                                        <input name="{{$k->nama}}[{{$x}}]" type="number"
                                            class="form-control @error('{{$k->nama}}[{{$x}}]') is-invalid @enderror"
                                            required>
                                        @else
                                        <select name="{{$k->nama}}[{{$x}}]" class="custom-select"
                                            id="inputGroupSelect01" required>
                                            <option value="" selected>Pilih Data</option>
                                            @if ($cek)
                                            @foreach ($kategori->where('kriteria_id', $k->id) as $ka)
                                            <option value="{{$ka->bobot}}">{{$ka->nama}}</option>
                                            @endforeach
                                            @else
                                            @foreach ($kategori->where('subkriteria_id', $k->id) as $ka)
                                            <option value="{{$ka->bobot}}">{{$ka->nama}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        @endif
                                        @error('{{$k->nama[$x]}}')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <button type="submit" class="btn btn-success float-right">
                        Hitung <i class="fas fa-arrow-right"></i>
                    </button>
                    {{-- <input type="submit" class="btn btn-success float-right" value="Hitung"> --}}
                </form>
                <a href="{{ route('sapi.index') }}" class="btn btn-danger"><i class="fas fa-arrow-left"></i>
                    Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
