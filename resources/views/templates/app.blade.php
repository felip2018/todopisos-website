<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="{{asset('assets/css/website.css')}}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('assets/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('assets/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('assets/plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- jQuery -->
  <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>



</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('assets/img/logo_todopisos_alt.png')}}" alt="Logo" width="100%">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <label class="d-block" id="username"></label>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" id="menu-app">
            <li class="nav-item">
                <a href="/app/administrator" class="nav-link">
                    <i class="nav-icon fas fa-home"></i> Inicio
                </a>
            </li>
            <li class="nav-item">
                <a href="/app/servicios" class="nav-link">
                    <i class="nav-icon far fa-image"></i> Servicios
                </a>
            </li>
            <li class="nav-item">
                <a href="/app/clientes" class="nav-link">
                    <i class="nav-icon fas fa-users"></i> Clientes
                </a>
            </li>
            <!--<li class="nav-item">
                <a href="/app/cotizaciones" class="nav-link">
                    <i class="nav-icon fas fa-list"></i> Cotizaciones
                </a>
            </li>-->
            <li class="nav-item">
                <a href="/app/quienes-somos" class="nav-link">
                    <i class="nav-icon fas fa-sitemap"></i> Quienes somos
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="closeSession()">
                    <i class="nav-icon fas fa-sign-out-alt"></i> Cerrar sesión
                </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @yield('content')
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="https://ifeelsoftware.com">IFeelSoftware</a></strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

</div>
<!-- ./wrapper -->

<!-- Modal -->
<div class="modal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap 4 -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/dist/js/adminlte.js')}}"></script>
<script src="{{asset('assets/js/variables.js')}}"></script>
<script>
  jQuery(document).ready(function(){
      const isLogin = validateSession();
      if (!isLogin) {
          closeSession();
      }
  });
</script>

<!--CORE-->
<script src="{{ asset('assets/js/session-core.js')}}"></script>
<script src="{{ asset('assets/js/clientes/core.js')}}"></script>
<script src="{{ asset('assets/js/servicios/core.js')}}"></script>
<script src="{{ asset('assets/js/productos/core.js')}}"></script>
<script src="{{ asset('assets/js/quienes-somos.js')}}"></script>
<script src="{{ asset('assets/js/quotation.js')}}"></script>
</body>
</html>
