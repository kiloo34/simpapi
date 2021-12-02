@extends('layouts.myview')
@section('content')
<h2 class="section-title">Halo, {{auth()->user()->peternak->nama_depan}}!</h2>
<p class="section-lead">
    Change information about yourself on this page.
</p>

<div class="row mt-sm-4">
    <div class="col-12 col-md-12 col-lg-5">
        <div class="card profile-widget">
            <div class="profile-widget-header">
                <img alt="image" src="{{auth()->user()->avatar}}" class="rounded-circle profile-widget-picture">
                <div class="profile-widget-items">
                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Sapi</div>
                        <div class="profile-widget-item-value">{{count($sapi->where('user_id', auth()->user()->id))}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="profile-widget-description">
                <div class="profile-widget-name">
                    {{auth()->user()->peternak->nama_depan.' '.auth()->user()->peternak->nama_belakang}}
                    <div class="text-muted d-inline font-weight-normal">
                        <div class="slash"></div> {{auth()->user()->role->nama}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12 col-lg-7">
        <div class="card">
            <form method="post" class="needs-validation" novalidate="">
                <div class="card-header">
                    <h4>Edit Profile</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="email">{{ __('Email') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ auth()->user()->email }}" tabindex="1" autocomplete="email"
                            autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="nama_depan">Nama Depan</label>
                            <input id="nama_depan" type="text"
                                class="form-control @error('nama_depan') is-invalid @enderror" name="nama_depan"
                                value="{{ auth()->user()->peternak->nama_depan }}" autocomplete="nama_depan" autofocus>
                            @error('nama_Depan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="nama_belakang">Nama Belakang</label>
                            <input id="nama_belakang" type="text"
                                class="form-control @error('nama_belakang') is-invalid @enderror" name="nama_belakang"
                                value="{{ auth()->user()->peternak->nama_belakang }}" autocomplete="nama_belakang"
                                autofocus>
                            @error('nama_belakang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">{{ __('No Handpone') }}</label>
                        <input id="no_hp" type="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                            name="no_hp" value="{{ auth()->user()->peternak->no_hp }}" tabindex="1" autocomplete="no_hp"
                            autofocus>
                        @error('no_hp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label>Alamat</label>
                            <textarea name="alamat"
                                class="form-control summernote-simple">{{auth()->user()->peternak->alamat}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
