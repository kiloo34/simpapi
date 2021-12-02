@extends('layouts.myview')
@section('content')

<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Kriteria</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="#" class="table table-striped">
                        <thead>
                            <th>{{__('No')}}</th>
                            <th>{{__('Kode')}}</th>
                            <th>{{__('Nama')}}</th>
                        </thead>
                        <tbody>
                            <?php $no=1 ?>
                            @foreach ($kriteria as $k)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$k->kode}}</td>
                                <td>{{ucfirst($k->nama)}}</td>
                                <?php $no++ ?>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ucfirst($title)}}</h4>
            </div>
            <div class="card-body">
                @if (isset($data))
                <a href="{{ route('nilaialternatif.create', 0) }}" class="btn btn-sm btn-success float-right ml-2 mb-3"
                    role="button">
                    <i class="fa fa-plus"></i>
                    {{__('Tambah Nilai Perbandingan')}}
                </a>
                @endif
                <a href="{{ route('alternatif.create') }}" class="btn btn-sm btn-success float-right ml-2 mb-3"
                    role="button">
                    <i class="fa fa-plus"></i>
                    {{__('Tambah Alternatif')}}
                </a>
                <div class="table-responsive">
                    <table id="alternatif" class="table table-striped">
                        <thead>
                            <th>{{__('No')}}</th>
                            <th>{{__('Kode')}}</th>
                            <th>{{__('Nama')}}</th>
                            <th>{{__('Aksi')}}</th>
                        </thead>
                        <tbody>
                            <?php $no=1 ?>
                            @foreach ($data as $d)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{isset($d->kode)?$d->kode:'klik detail'}}</td>
                                <td>{{ucfirst($d->nama)}}</td>
                                <td>
                                    <a href="{{ route('alternatif.edit', $d->id) }}" class="btn btn-sm btn-info"
                                        data-toggle="tooltip" data-placement="top" title="Edit Data" role="button">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <a href="{{ route('alternatif.destroy', $d->id) }}"
                                        class="btn btn-sm btn-danger hapus" data-toggle="tooltip" data-placement="top"
                                        title="Hapus Data" data-id="{{ $d->id }}">
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
@push('scripts')
<script>
    $(document).ready(function() {
        $('#alternatif').DataTable();
    });
    $('.hapus').on('click', function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var id = $(this).data("id");
        // var url = $('.hapus').attr('href');
        var url = "{{ route('alternatif.destroy', ":id") }}";
        url = url.replace(':id', id);
        $object=$(this);

        Swal.fire({
            title: 'Are you sure?',
            text: "Yakin ingin menghapus data alternatif ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {id: id},
                    success: function (response) {
                        $($object).parents('tr').remove();
                        Swal.fire({
                            title: "Data Dihapus!",
                            text: response.message,
                            icon: 'success',
                        })
                    },
                    error: function (data) {
                        Swal.fire({
                            title: "Data Gagal Dihapus!",
                            icon: 'error',
                        })
                    }
                });
            }
        });
    })
</script>
@endpush
@endsection
@include('import.datatable')
