@extends('layouts.myview')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ucfirst($title)}}</h4>
            </div>
            <div class="card-body">
                <div class="col-md-6 col-sm-12 float-right">
                    <div class="d-flex justify-content-center">
                        <label>Tambah Data Sapi</label>
                    </div>
                    <div class="btn-group btn-block mb-3" role="group">
                        <a href="{{ route('manual.create') }}" class="btn btn-info" role="button">Manual</a>
                        {{-- <a href="{{ route('rekomendasi.create') }}" class="btn btn-info"
                        role="button">Rekomendasi</a> --}}
                        <button class="btn btn-primary" id="modal-2">Rekomendasi</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="alternatif" class="table table-striped">
                        <thead>
                            <th>{{__('No')}}</th>
                            <th>{{__('Jenis Sapi')}}</th>
                            <th>{{__('Harga Beli')}}</th>
                            <th>{{__('Aksi')}}</th>
                        </thead>
                        <tbody>
                            <?php $no=1 ?>
                            @foreach ($data as $d)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{ucfirst($d->nama)}}</td>
                                <td>Rp. {{number_format($d->harga_beli)}}</td>
                                <td>
                                    <a href="" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top"
                                        title="Edit Data" role="button">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <a href="" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                                        title="Hapus Data" role="button">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
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

<form action="{{ route('rekomendasi.create') }}" class="modal-part" id="modal-jumlah">
    @csrf
    <p>Masukan Jumlah yang ingin dibandingkan</p>
    <div class="form-group">
        <label>Jumlah</label>
        <input name="jumlah" type="text" class="form-control @error('jumlah') is-invalid @enderror" required>
        @error('jumlah')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</form>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#alternatif').DataTable();
    });

    $("#modal-2").fireModal({
        title: 'Rekomendasi',
        body: $("#modal-jumlah"),
        footerClass: 'bg-whitesmoke',
        autoFocus: false,
        onFormSubmit: function(modal, e, form) {
            // Form Data
            let form_data = $(e.target).serialize();
            console.log(form_data)

            // DO AJAX HERE
            let ajax = setTimeout(function() {

                form.stopProgress();
                modal.find('.modal-body').prepend('<div class="alert alert-info">Please check your browser console</div>')

                clearInterval(ajax);
            }, 1500);

            // e.preventDefault();

        },
        shown: function(modal, form) {
            console.log(form)
        },
        buttons: [
            {
                text: 'Submit',
                submit: true,
                class: 'btn btn-primary btn-shadow',
                handler: function(modal) {
                }
            }
        ]
    });

</script>
@endpush
@endsection
@include('import.datatable')
