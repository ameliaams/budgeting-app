<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield ('title') | Budgeting</title>
  
  <script src="{{ asset('js/app.js') }}"></script> <!-- Ini adalah aset yang dihasilkan dari kompilasi Anda -->
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <!-- editable -->
  <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css" rel="stylesheet" />
  <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js"></script>
  <!-- modal -->
  <!-- Add these lines inside the <head> section of your layout file -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- ... Other meta tags and CSS links ... -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- SweetAlert CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">

  <!-- SweetAlert JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
  <!-- <script src="link-ke-sweetalert.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fullcalendar/main.css') }}">

  <style>
    .level-one-row {
      background-color: #DCDCDC;
      color: #000;
      font-weight: bold;
    }

    .level-null {
      background-color: #90EE90;
      color: #000;
      font-weight: bold;
    }

    .alert-success {
      background-color: #4CAF50;
      /* Warna hijau */
      color: white;
      /* Warna teks putih */
      padding: 10px;
      /* Jarak antara teks dan pinggiran div */
      border-radius: 5px;
      /* Membuat sudut div menjadi melengkung */
    }

    /* Gaya untuk alert dengan teks merah */
    .alert-danger {
      background-color: #f44336;
      /* Warna merah */
      color: white;
      /* Warna teks putih */
      padding: 10px;
      /* Jarak antara teks dan pinggiran div */
      border-radius: 5px;
      /* Membuat sudut div menjadi melengkung */
    }

    .swal-custom-size {
      max-width: 100px;
    }

    [data-toggle="toggle"] {
	display: none;
}
  </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  
  <div class="wrapper">

    <!-- Preloader
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('admin/dist/img/B.png') }}" height="60" width="60">
  </div> -->

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="/home" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa-solid fa-right-from-bracket"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
            <i class="fa-solid fa-gear"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="home" class="brand-link">
        <img src="https://drive.google.com/uc?id=13R7E34OIt03i6eiBszu53Zn3WIW9qt4Y" alt="LOGO" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Budgeting</span>
      </a>


      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/Circle-icons-profile.svg/1200px-Circle-icons-profile.svg.png" class="img-circle elevation-2" alt="User Image">
          </div>
          @if(isset($user))
              <div class="info">
                  <a class="d-block" style="font-weight: bold; font-size: 18px;">
                      {{ $user->username }}
                  </a>
              </div>
          @endif
        </div>


        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item {{ isActiveDashboard() ? 'menu-open' : '' }}">
              <a href="{{ asset('/home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item {{ isActiveMaster() ? 'menu-open' : '' }}">
              <a href="javascript:void(0);" class="nav-link {{ isActiveMaster() ? 'active' : '' }}">
                <i class="nav-icon fas fa-key"></i>
                <p>
                  Master
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ asset('/coa') }}" class="nav-link {{ Request::is('coa') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Master COA</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ asset('/rab') }}" class="nav-link {{ Request::is('rab') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Master RAB</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ asset('/tahun') }}" class="nav-link {{ Request::is('tahun') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Master Tahun Anggaran</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ asset('/kas') }}" class="nav-link {{ Request::is('kas') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Master Kas</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item {{ isActiveTransaksi() ? 'menu-open' : '' }}">
              <a href="javascript:void(0)" class="nav-link {{ isActiveTransaksi() ? 'active' : '' }}">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>
                  Transaksi
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ asset('/masuk') }}" class="nav-link {{ Request::is('kasMasuk') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Transaksi Masuk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ asset('/keluar') }}" class="nav-link {{ Request::is('kasKeluar') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Transaksi Keluar</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item {{ isActiveLaporan() ? 'menu-open' : '' }}">
              <a href="javascript:void(0)" class="nav-link {{ isActiveLaporan() ? 'active' : '' }}">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Laporan
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ asset('/laporanRealisasi') }}" class="nav-link {{ Request::is('laporanRealisasi') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Realisasi RAB</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ asset('/laporanTransaksiMasuk') }}" class="nav-link {{ Request::is('laporanTransaksiMasuk') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Kas Masuk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ asset('/laporanTransaksiKeluar') }}" class="nav-link {{ Request::is('laporanTransaksiKeluar') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Kas Keluar</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ asset('/arusKas') }}" class="nav-link {{ Request::is('arusKas') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Arus Kas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ asset('/laporanTotalKas') }}" class="nav-link {{ Request::is('laporanTotalKas') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Total Kas</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item {{ isActiveDiagram() ? 'menu-open' : '' }}">
            <a href="{{ asset('/chart') }}" class="nav-link {{ Request::is('chart') ? 'active' : '' }}">
            <i class="nav-icon fas fa-chart-line"></i> 
                <p>
                  Diagram
                </p>
              </a>
            </li>
            <li class="nav-item {{ isActiveCalendar() ? 'menu-open' : '' }}">
            <a href="{{ asset('/kalender') }}" class="nav-link {{ Request::is('kalender') ? 'active' : '' }}">
            <i class="nav-icon fas fa-calendar"></i> 
                <p>
                  Kalender
                </p>
              </a>
            </li>
            <li class="nav-item {{ isActiveCollapse() ? 'menu-open' : '' }}">
            <a href="{{ asset('/collapse') }}" class="nav-link {{ Request::is('collapse') ? 'active' : '' }}">
            <i class="nav-icon fas fa-hashtag"></i> 
                <p>
                  Collapse
                </p>
              </a>
            </li>
            <!-- <li class="nav-item">
            <a href="{{ asset('/ubah') }}" class="nav-link {{ Request::is('ubah') ? 'active' : '' }}">
              <i class="fas fa-edit"></i>
                <p>
                  Ubah Password
                </p>
              </a>
            </li> -->
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">@yield('title')</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active">@yield('title')</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2023 <a href="#">Budgeting</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <script>
  function toggleSubmenu() {
    const submenu = this.querySelector('.nav-treeview');
    if (submenu) {
      submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
    }
  }

  const menuItems = document.querySelectorAll('.nav-item');
  menuItems.forEach((item) => {
    item.addEventListener('click', toggleSubmenu);
  });
</script>

  <!-- jQuery -->
  <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- ChartJS -->
  <script src="{{ asset('admin/plugins/chart.js/Chart.min.js') }}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('admin/plugins/sparklines/sparkline.js') }}"></script>
  <!-- JQVMap -->
  <script src="{{ asset('admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <!-- Summernote -->
  <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('admin/dist/js/pages/dashboard.js') }}"></script>
  <!-- fullCalendar 2.2.5 -->
<script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('admin/plugins/fullcalendar/main.js') }}"></script>

</body>

</html>