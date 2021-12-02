@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-12">
        <a href="{{ route('sapi.index') }}" class="btn btn-sm btn-danger mb-3 float-right" role="button">
            <i class="fa fa-arrow-left"></i>
            {{__('Kembali')}}
        </a>
    </div>
</div>
<div class="row">
    @php
    $no = 1;
    @endphp
    @foreach ($pilihan as $p)
    @if ($p['alternatif'] != null)
    <div class="col-12 col-md-4 col-lg-4">
        <div class="pricing pricing-highlight">
            <div class="pricing-title">
                {{$p['alternatif']['nama']}}
            </div>
            <div class="pricing-padding">
                <div class="pricing-price">
                    <div>{{$no}}</div>
                    <div>Ranking</div>
                    <br>
                    <div>Nilai</div>
                    <div><b>{{$p['nilai']}}</b></div>
                </div>
                <div class="pricing-details">
                    <div class="pricing-item">
                        <div class="pricing-item-icon"><i class="fas fa-minus"></i></div>
                        <div class="pricing-item-label">Rp. {{number_format($p['harga'])}}</div>
                    </div>
                </div>
            </div>
            <div class="pricing-cta">
                <form action="{{ route('sapi.store') }}" target="__blank" class="pilih" method="post">
                    @csrf
                    <input type="hidden" name="jenis" value="rekomendasi">
                    <input type="hidden" name="harga" value="{{$p['harga']}}">
                    <input type="hidden" name="alternatif" value="{{$p['alternatif']['nama']}}">
                    <button type="submit" class="btn btn-block btn-primary btn-lg pilih">Pilih <i
                            class="fas fa-arrow-right"></i></button>
                </form>
                {{-- <a href="#">Pilih <i class="fas fa-arrow-right"></i></a> --}}
            </div>
        </div>
    </div>
    @php
    $no++;
    @endphp
    @endif
    @endforeach
</div>
@endsection
@include('import.datatable')

{{-- @push('scripts')
<script>
    $(document).ready(function () {
        $(".pilih").on('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Anda yakin memilih pilihan sapi ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, pilih ini!',
                cancelButtonText: 'batal'
                }).then((result) => {
                if (result.value) {
                    var $this = $(this);
                    $.ajax({
                        url: '{{ route("sapi.store") }}',
async: false,
success: function (url) {
$this.attr("href", url);
$this.attr("target", "_blank");
},
error: function () {
e.preventDefault();
}
});
}
});
});
});
</script>
@endpush --}}
