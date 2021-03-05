<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>AdminLTE 3 | Dashboard</title>

  <link rel="stylesheet"  href="{{asset('css/app.css')}}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/ionicons/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  {{-- <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"> --}}
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/jqvmap/jqvmap.min.css">
  
  
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/summernote/summernote-bs4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/select2/css/select2.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/backend')}}/dist/css/adminlte.min.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <navbar-component></navbar-component>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside-component></aside-component>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <router-view></router-view>

    <!-- set progressbar -->
    <vue-progress-bar></vue-progress-bar>
    <!-- Vue Snotify -->
    <vue-snotify></vue-snotify>

    

  </div>
  <!-- /.content-wrapper -->

  <footer-component></footer-component>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

  <script src="{{mix('js/app.js')}}" dafer></script>
  <!-- jQuery -->
  {{-- <script src="{{asset('assets/backend')}}/plugins/jquery/jquery.min.js"></script> --}}
  <!-- jQuery UI 1.11.4 -->
  <script src="{{asset('assets/backend')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  {{-- <script src="{{asset('assets/backend')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
  <!-- ChartJS -->
  <script src="{{asset('assets/backend')}}/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="{{asset('assets/backend')}}/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="{{asset('assets/backend')}}/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="{{asset('assets/backend')}}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{asset('assets/backend')}}/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="{{asset('assets/backend')}}/plugins/moment/moment.min.js"></script>
  <script src="{{asset('assets/backend')}}/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{asset('assets/backend')}}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  
  <!-- Select2 -->
  <script src="{{asset('assets/backend')}}/plugins/select2/js/select2.full.min.js"></script>
  <!-- Summernote -->
  <script src="{{asset('assets/backend')}}/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="{{asset('assets/backend')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  

  <!-- AdminLTE App -->
  <script src="{{asset('assets/backend')}}/dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('assets/backend')}}/dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{asset('assets/backend')}}/dist/js/pages/dashboard.js"></script>
  <script>
    $(document).ready(function () {
      $('.select2').select2()
    });
  </script>
</body>
</html>
