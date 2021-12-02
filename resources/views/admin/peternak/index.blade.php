@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ucfirst($title)}}</h4>
            </div>
            <div class="card-body">
                {{-- @if (isset($data))
                <a href="{{ route('nilaikriteria.create') }}" class="btn btn-sm btn-success float-right ml-2 mb-3"
                role="button">
                <i class="fa fa-plus"></i>
                {{__('Tambah Nilai Perbandingan')}}
                </a>
                @endif
                <a href="{{ route('kriteria.create') }}" class="btn btn-sm btn-success float-right mb-3" role="button">
                    <i class="fa fa-plus"></i>
                    {{__('Tambah Kriteria')}}
                </a> --}}
                <div class="table-responsive">
                    <table id="dt" class="table table-striped">
                        <thead>
                            <th>{{__('No')}}</th>
                            <th>{{__('Nama')}}</th>
                            <th>{{__('Nomor Telepon')}}</th>
                            <th>{{__('Total Sapi')}}</th>
                            <th>{{__('Aksi')}}</th>
                        </thead>
                        <tbody>
                            <?php $no=1 ?>
                            @foreach ($data as $d)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$d->peternak->nama_depan . ' ' . $d->peternak->nama_belakang}}</td>
                                <td>{{isset($d->peternak->no_hp)?$d->peternak->no_hp:'kosong'}}</td>
                                <td>{{count($sapi->where('user_id', $d->id))}}</td>
                                <td>
                                    <a href="{{ route('kriteria.edit', $d->id) }}" class="btn btn-sm btn-info"
                                        role="button">
                                        <i class="fa fa-pen"></i>
                                        {{__('Detail')}}
                                    </a>
                                </td>
                            </tr>
                            @php
                            $no++
                            @endphp
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
        $('#dt').DataTable();
    });

    // $('.hapus').on('click', function (e) {
    //     e.preventDefault();

    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });

    //     var id = $(this).data("id");
    //     // var url = $('.hapus').attr('href');
    //     var url = "{{ route('kriteria.destroy', ":id") }}";
    //     url = url.replace(':id', id);
    //     $object=$(this);

    //     Swal.fire({
    //         title: 'Hapus data ini?',
    //         text: "Yakin ingin menghapus data kriteria ini!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Ya!'
    //         }).then((result) => {
    //         if (result.value) {
    //             $.ajax({
    //                 url: url,
    //                 type: 'DELETE',
    //                 data: {id: id},
    //                 success: function (response) {
    //                     $($object).parents('tr').remove();
    //                     Swal.fire({
    //                         title: "Data Dihapus!",
    //                         text: response.message,
    //                         icon: 'success',
    //                     })
    //                 },
    //                 error: function (data) {
    //                     Swal.fire({
    //                         title: "Data Gagal Dihapus!",
    //                         icon: 'error',
    //                     })
    //                 }
    //             });
    //         }
    //     });
    // })
</script>
@endpush
@endsection
@include('import.datatable')
