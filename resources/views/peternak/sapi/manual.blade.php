@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Tambah {{ucfirst($title)}}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('sapi.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="jenis" value="">
                    <div class="form-group">
                        <label>Jenis Sapi</label>
                        <select name="alternatif" class="custom-select" id="inputGroupSelect01" required>
                            <option value="" selected>Pilih Data</option>
                            @foreach ($alternatif as $alt)
                            <option value="{{$alt->nama}}">{{$alt->nama}}</option>
                            @endforeach
                        </select>
                        @error('alternatif')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Harga</label>
                        <input name="harga" type="text" class="form-control @error('harga') is-invalid @enderror">
                        @error('harga')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <input type="submit" class="btn btn-success float-right" value="Tambah">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
