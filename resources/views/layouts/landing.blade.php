<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title>SIMPAPI</title>

        <!-- General CSS Files -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
            integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        <!-- CSS Libraries -->

        <!-- Template CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

        @stack('css')
        @stack('styles')

    </head>

    <body class="layout-3">
        <div id="app">
            <div class="main-wrapper container">
                <div class="navbar-bg"></div>
                <nav class="navbar navbar-expand-lg main-navbar">
                    <a href="{{ route('landing') }}" class="navbar-brand sidebar-gone-hide">SIMPAPI</a>
                    <div class="navbar-nav">
                        <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i
                                class="fas fa-bars"></i></a>
                    </div>
                    {{-- <div class="nav-collapse">
                        <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
                            <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <ul class="navbar-nav">
                            <li class="nav-item active"><a href="#" class="nav-link">Application</a></li>
                            <li class="nav-item"><a href="#" class="nav-link">Report Something</a></li>
                            <li class="nav-item"><a href="#" class="nav-link">Server Status</a></li>
                        </ul>
                    </div> --}}
                    <form class="form-inline ml-auto">
                        <ul class="navbar-nav">
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                                        class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search"
                                data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                            <div class="search-backdrop"></div>
                            <div class="search-result">
                                <div class="search-header">
                                    Histories
                                </div>
                                <div class="search-item">
                                    <a href="#">How to hack NASA using CSS</a>
                                    <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                                </div>
                                <div class="search-item">
                                    <a href="#">Kodinger.com</a>
                                    <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                                </div>
                                <div class="search-item">
                                    <a href="#">#Stisla</a>
                                    <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                                </div>
                                <div class="search-header">
                                    Result
                                </div>
                                <div class="search-item">
                                    <a href="#">
                                        <img class="mr-3 rounded" width="30"
                                            src="../assets/img/products/product-3-50.png" alt="product">
                                        oPhone S9 Limited Edition
                                    </a>
                                </div>
                                <div class="search-item">
                                    <a href="#">
                                        <img class="mr-3 rounded" width="30"
                                            src="../assets/img/products/product-2-50.png" alt="product">
                                        Drone X2 New Gen-7
                                    </a>
                                </div>
                                <div class="search-item">
                                    <a href="#">
                                        <img class="mr-3 rounded" width="30"
                                            src="../assets/img/products/product-1-50.png" alt="product">
                                        Headphone Blitz
                                    </a>
                                </div>
                                <div class="search-header">
                                    Projects
                                </div>
                                <div class="search-item">
                                    <a href="#">
                                        <div class="search-icon bg-danger text-white mr-3">
                                            <i class="fas fa-code"></i>
                                        </div>
                                        Stisla Admin Template
                                    </a>
                                </div>
                                <div class="search-item">
                                    <a href="#">
                                        <div class="search-icon bg-primary text-white mr-3">
                                            <i class="fas fa-laptop"></i>
                                        </div>
                                        Create a new Homepage Design
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav navbar-right">
                        <ul class="navbar-nav">
                            @auth
                            @if (auth()->user()->role->nama == 'admin')
                            <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link">Beranda</a>
                            </li>
                            @else
                            <li class="nav-item"><a href="{{ route('peternak.dashboard') }}"
                                    class="nav-link">Beranda</a></li>
                            @endif

                            @else
                            <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                            @if (Route::has('register'))
                            <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                            @endif
                            @endauth
                        </ul>
                    </ul>
                </nav>

                <!-- Main Content -->
                <div class="main-content">
                    <section class="section">
                        <div class="section-body">
                            @yield('content')
                        </div>
                    </section>
                </div>
                <x-footer />
            </div>
        </div>

        <!-- General JS Scripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="{{ asset('assets/js/stisla.js') }}"></script>

        <!-- JS Libraies -->

        <!-- Page Specific JS File -->

        <!-- Template JS File -->
        <script src="{{ asset('assets/js/scripts.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>

        @stack('js')
        @stack('scripts')

    </body>

</html>
