<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sistem Informasi PRODUKSI</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #4680c3;">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center mb-2" href="index.html">
                <div class="sidebar-brand-icon">
                    <img src="{{asset('image/logo.png')}}" alt="logo" class="img-fluid rounded-circle shadow">
                </div>
                <div class="sidebar-brand-text mx-3">SISTEM PRODUKSI</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            @if(Auth::user()->level == 1 || Auth::user()->level == 2)
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Master
            </div>
            @endif

            @if(Auth::user()->level == 1)
            <!-- Nav Item - Charts -->
            <li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
                <a class="nav-link py-1" href="{{ url('users') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Users</span></a>
            </li>
            @endif

            @if(Auth::user()->level == 1 || Auth::user()->level == 2)
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item {{ Request::is('mesin*') ? 'active' : '' }}">
                <a class="nav-link py-1" href="{{ url('mesin') }}">
                    <i class="fas fa-fw fa-clipboard"></i>
                    <span>Data Mesin</span></a>
            </li>
            <li class="nav-item {{ Request::is('kain*') ? 'active' : '' }}">
                <a class="nav-link py-1" href="{{ url('kain') }}">
                    <i class="fas fa-fw fa-clipboard"></i>
                    <span>Data Kain</span></a>
            </li>
            @endif

            @if(Auth::user()->level == 3 || Auth::user()->level == 4)
            <!-- Nav Item - Utilities Collapse Menu -->

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Produksi
            </div>
            @endif

            @if(Auth::user()->level == 3 || Auth::user()->level == 4)
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {{ Request::is('jadwal*') ? 'active' : '' }}">
                <a class="nav-link py-1" href="{{ url('jadwal') }}">
                    <i class="fas fa-fw fa-business-time"></i>
                    <span>Jadwal produksi</span></a>
            </li>
            @endif

            @if(Auth::user()->level == 3)
            <!-- Nav Item - Charts -->
            <li class="nav-item {{ Request::is('produksi*') ? 'active' : '' }}">
                <a class="nav-link py-1" href="{{ url('produksi') }}">
                    <i class="fas fa-fw fa-archive"></i>
                    <span>Data Produksi</span></a>
            </li>
            @endif

            @if(Auth::user()->level == 1 || Auth::user()->level == 2)
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Heading -->
            <div class="sidebar-heading">
                Laporan
            </div>

            <li class="nav-item {{ Request::is('laporan*') ? 'active' : '' }}">
                <a class="nav-link py-1" href="{{ url('laporan') }}">
                    <i class="fas fa-chart-bar"></i>
                    <span>Laporan Produksi</span></a>
            </li>
            @endif

            <!-- Sidebar Toggler (Sidebar) -->
            <!-- <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div> -->

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>

                </button>

                <div>
                    <h2>Tanggal {{ date_format(date_create(now()->format('Y-m-d')), "d F Y") }}</h2>
                </div>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                            $level = '';
                            switch (Auth::user()->level) {
                                case '1':
                                    $level = 'Manager';
                                    break;
                                case '2':
                                    $level = 'Admin produksi';
                                    break;
                                case '3':
                                    $level = 'Operator';
                                    break;
                                case '4':
                                    $level = 'PPIC';
                                    break;
                            }
                            ?>
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><b>{{ $level }}</b> - {{ auth()->user()->name }}</span>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class=" dropdown-item bg-light border-0"><i class="fa fa-power-off"></i> Logout</a>
                                </button>
                            </form>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                @yield('container')
            </div>
        </div>
    </div>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>

</html>