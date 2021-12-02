@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ucfirst($title)}} {{$kriteria->nama}}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('kategorikriteria.store', $kriteria->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Nama</label>
                        <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror">
                        @error('nama')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    @if ($kriteria->nama == 'harga')
                    <p><small>*jika pertama masukan batas bawah sampai tertinggi*</small></p>
                    @else
                    <p><small>*jika pertama masukan batas atas sampai dengan terbawah*</small></p>
                    @endif
                    <input type="submit" class="btn btn-success float-right" value="Tambah">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
