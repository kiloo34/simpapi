<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">{{__("SIMPAPI")}}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">{{__("SPP")}}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ $active == 'dashboard' ? 'active' : null }}"">
                @if (auth()->user()->role_id == 1)
                <a class=" nav-link" href="{{ route('admin.dashboard') }}">
                @else
                <a class="nav-link" href="{{ route('peternak.dashboard') }}">
                    @endif
                    <i class="fa fa-home"></i>
                    <span>{{__('Dashboard')}}</span>
                </a>
            </li>
            <li class="menu-header">Sapiku</li>
            @if (auth()->user()->role_id == 1)
            <li
                class="nav-item dropdown {{ $active == 'kriteria' || $active == 'subkriteria' || $active == 'alternatif' || $active == 'hasil' ? 'active' : null }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fa fa-ellipsis-h"></i>
                    <span>{{__('SPK')}}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ $active == 'kriteria' || $active == 'subkriteria' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('kriteria.index') }}">{{__('Kriteria')}}</a>
                    </li>
                    <li class="{{ $active == 'alternatif' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('alternatif.index') }}">{{__('Alternatif')}}</a>
                    </li>
                    <li class="{{ $active == 'hasil' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('hasilalternatif.index') }}">{{__('Hasil Ranking')}}</a>
                    </li>
                </ul>
            </li>
            {{-- <li class="nav-item dropdown {{ $active == 'bobot.kriteria' ? 'active' : null }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                <i class="fa fa-ellipsis-h"></i>
                <span>{{__('Perhitungan')}}</span></a>
            <ul class="dropdown-menu">
                <li class="{{ $active == 'bobot.kriteria' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('bobotkriteria.index') }}">{{__('Kriteria')}}</a>
                </li>
            </ul>
            </li> --}}
            <li class="{{ $active == 'peternak' ? 'active' : null }}">
                <a class=" nav-link" href="{{ route('peternak.index') }}">
                    <i class="fa fa-user"></i>
                    <span>{{__('Peternak')}}</span>
                </a>
            </li>
            @else
            <li class="nav-item dropdown {{ $active == 'sapi' ? 'active' : '' }}">
                <a class="{{ $active == 'sapi' ? 'active' : '' }}" nav-link" href="{{ route('sapi.index') }}">
                    <i class="fa fa-paw"></i>
                    <span>{{__('Sapiku')}}</span>
                </a>
            </li>
            @endif
        </ul>
    </aside>
</div>

{{-- <li class="{{ $active == 'bobot.alternatif' ? 'active' : '' }}">
<a class="nav-link" href="{{ route('bobotalternatif.index') }}">{{__('Alternatif')}}</a>
</li>
<li class="{{ $active == 'bobot.kriteria' ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('bobotkriteria.index') }}">{{__('Kriteria')}}</a>
</li>
<li class="{{ $active == 'bobot.subkriteria' ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('bobotsubkriteria.index') }}">{{__('Subkriteria')}}</a>
</li>
<li class="{{ $active == 'bobot.kategori' ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('bobotkategori.index') }}">{{__('Kategori')}}</a>
</li> --}}
