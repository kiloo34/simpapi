@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ucfirst($title) . ' ' . $kriteria->nama}}</h4>
            </div>
            <div class="card-body">
                <a href="{{ route('kriteria.index', $kriteria->id) }}" class="btn btn-sm btn-danger mb-3" role="button">
                    <i class="fa fa-arrow-left"></i>
                    {{__('Kembali')}}
                </a>
                @if (isset($data))
                <a href="{{ route('nilaikategorikriteria.create', $kriteria->id) }}"
                    class="btn btn-sm btn-success float-right ml-2 mb-3" role="button">
                    <i class="fa fa-plus"></i>
                    {{__('Tambah Nilai Perbandingan')}}
                </a>
                @endif
                <a href="{{ route('kategorikriteria.create', $kriteria->id) }}"
                    class="btn btn-sm btn-success float-right mb-3" role="button">
                    <i class="fa fa-plus"></i>
                    {{__('Tambah Kategori '.$kriteria->nama)}}
                </a>
                <div class="table-responsive">
                    <table id="dt" class="table table-striped">
                        <thead>
                            <th>{{__('No')}}</th>
                            <th>{{__('Nama')}}</th>
                            <th>{{__('Aksi')}}</th>
                        </thead>
                        <tbody>
                            <?php $no=1 ?>
                            {{-- {{dd($data)}} --}}
                            @foreach ($data as $d)
                            {{-- {{dd($d->nama)}} --}}
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$kriteria->nama == 'harga'?number_format($d->nama): $d->nama}}</td>
                                <td>
                                    <a href="{{ route('kategorikriteria.edit', ['id'=>$kriteria->id, 'kategoriId'=>$d->id]) }}"
                                        class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top"
                                        title="Edit Data" role="button">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <a href="{{ route('kategorikriteria.destroy', ['id'=>$kriteria->id, 'kategoriId'=>$d->id]) }}"
                                        class="btn btn-sm btn-danger hapus" data-toggle="tooltip" data-placement="top"
                                        title="Hapus Data" data-id="{{ $kriteria->id }}" data-kategoriId="{{$d->id}}">
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
        var kategoriId = $(this).attr("data-kategoriId");
        var url = "{{ route('kategorikriteria.destroy', ['id'=>":id",'kategoriId'=>":kategoriId"]) }}";
        url = url.replace(':id', id);
        url = url.replace(':kategoriId', kategoriId);
        console.log(id, kategoriId, url);
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
