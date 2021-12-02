@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ucfirst($title)}}</h4>
            </div>
            <div class="card-body">
                @if (isset($data))
                <a href="{{ route('nilaikriteria.create') }}" class="btn btn-sm btn-success float-right ml-2 mb-3"
                    role="button">
                    <i class="fa fa-plus"></i>
                    {{__('Tambah Nilai Perbandingan')}}
                </a>
                @endif
                <a href="{{ route('kriteria.create') }}" class="btn btn-sm btn-success float-right mb-3" role="button">
                    <i class="fa fa-plus"></i>
                    {{__('Tambah Kriteria')}}
                </a>
                <div class="table-responsive">
                    <table id="dt" class="table table-striped">
                        <thead>
                            <th>{{__('No')}}</th>
                            <th>{{__('Kode')}}</th>
                            <th>{{__('Nama')}}</th>
                            <th>{{__('Total Subkriteria')}}</th>
                            <th>{{__('Aksi')}}</th>
                        </thead>
                        <tbody>
                            <?php $no=1 ?>
                            @foreach ($data as $d)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{isset($d->kode)?$d->kode:'klik detail'}}</td>
                                <td>{{ucfirst($d->nama)}}</td>
                                <td>{{isset($d->kode)?'0':count($sub->where('kriteria_id', $d->id))}}</td>
                                <td>
                                    <a href="{{ route('kriteria.edit', $d->id) }}" class="btn btn-sm btn-info"
                                        data-toggle="tooltip" data-placement="top" title="Edit Data" role="button">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    {{-- {{dd($kategori->where('kriteria_id', $d->id))}} --}}
                                    @if (isset($d->kode))
                                    @if (count($kategori->where('kriteria_id', $d->id)) == 0)
                                    <a href="{{ route('subkriteria.create', $d->id) }}" class="btn btn-sm btn-success"
                                        data-toggle="tooltip" data-placement="top" title="Tambah Subkriteria"
                                        role="button">
                                        <i class="fa fa-plus"></i>
                                        {{__('Subkriteria')}}
                                    </a>
                                    @endif
                                    <a href="{{ route('kategorikriteria.index', $d->id) }}"
                                        class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                                        title="Detail Kategori" role="button">
                                        <i class="fa fa-search"></i>
                                        {{__('Kategori')}}
                                    </a>
                                    @else
                                    <a href="{{ route('subkriteria.index', $d->id) }}" class="btn btn-sm btn-primary"
                                        data-toggle="tooltip" data-placement="top" title="Detail Subkriteria"
                                        role="button">
                                        <i class="fa fa-search"></i>
                                        {{__('Subkriteria')}}
                                    </a>
                                    @endif
                                    <a href="{{ route('kriteria.destroy', $d->id) }}"
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
        $('#dt').DataTable();
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
        var url = "{{ route('kriteria.destroy', ":id") }}";
        url = url.replace(':id', id);
        $object=$(this);

        Swal.fire({
            title: 'Hapus data ini?',
            text: "Yakin ingin menghapus data kriteria ini!",
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
