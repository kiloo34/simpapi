@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Tambah {{ucfirst($title) . ' '. ucfirst($kriteria->nama)}}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('subkriteria.store', $kriteria->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Kode</label>
                        <input name="kode" type="text" class="form-control @error('kode') is-invalid @enderror"
                            value="{{ old('kode') }}" autocomplete="kode" autofocus>
                        @error('kode')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('nama') }}" autocomplete="nama" autofocus>
                        @error('nama')
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
