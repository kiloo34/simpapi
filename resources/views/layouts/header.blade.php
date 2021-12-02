<div class="section-header">
    <h1>{{ucfirst($title)}}</h1>
    <div class="section-header-breadcrumb">
        @if (auth()->user()->role_id == 1)
        <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">SIMPAPI</a></div>
        @else
        <div class="breadcrumb-item"><a href="{{ route('peternak.dashboard') }}">SIMPAPI</a></div>
        @endif
        @if ($subtitle == null)
        <div class="breadcrumb-item active"><a
                href="{{ route(auth()->user()->role->nama.'.dashboard') }}">{{ucfirst($title)}}</a></div>
        @else
        @if ($title == 'dashboard')
        <div class="breadcrumb-item"><a href="#">{{ucfirst($title)}}</a></div>
        @else
        <div class="breadcrumb-item"><a href="{{ route($title.'.index', $id ?? '') }}">{{ucfirst($title)}}</a></div>
        @endif
        <div class="breadcrumb-item active">{{ucfirst($subtitle)}}</div>
        @endif
    </div>
</div>
