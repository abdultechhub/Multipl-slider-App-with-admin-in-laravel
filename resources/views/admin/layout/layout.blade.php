<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Slider Management</title>
    <link rel="shortcut icon" href="{{ asset('admin/assets/img/favicon.png') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('admin/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">


    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/summernote/summernote-bs4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/toastr/toastr.min.css') }}">


    @yield('custom_style_link')

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/adminlte.min.css') }}">



    <!-- installer Styles -->
    <link href="{{ asset('admin/assets/css/ab_style.css') }}" rel="stylesheet">

    @yield('custom_style')


    <!--installer Scripts -->


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    {{-- <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('admin.layout.header')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.layout.sidebar')
      <!-- partial -->
      @yield('content')
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller --> --}}


    <div class="wrapper">


        {{-- Header START --}}
        @include('admin.layout.header')
        {{-- Header END --}}

        <!-- Main Sidebar Container -->
        @include('admin.layout.sidebar')


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                @yield('content')
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        {{-- Footer START --}}
        @include('admin.layout.footer')
        {{-- Footer END --}}


        <!-- Control Sidebar -->
        {{-- @include('admin.dashboard_layout.sidebar') --}}
        <!-- /.control-sidebar -->


    </div>


    <!-- jQuery -->
    <script src=" {{ asset('admin/assets/plugins/jquery/jquery.min.js') }}"></script>
    {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('admin/assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

    <!-- Select2 -->
    <script src="{{ asset('admin/assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <script src="{{ asset('admin/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>


    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('admin/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    <!-- Summernote -->
    <script src="{{ asset('admin/assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('admin/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>


    <!-- Toastr -->
    <script src="{{ asset('admin/assets/plugins/toastr/toastr.min.js') }}"></script>


    <!-- AdminLTE App -->
    <script src="{{ asset('admin/assets/js/adminlte.min.js') }}"></script>




    <!-- custom js -->
    <script src="{{ asset('admin/assets/js/custom_js.js') }}"></script>


    <!-- Control Sidebar -->
    {{-- @include('admin.dashboard_layout.script') --}}
    <!-- /.control-sidebar -->

    @yield('custom_script')

    @include('admin.layout.script')


    <script></script>

</body>

</html>
