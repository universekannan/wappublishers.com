<!DOCTYPE html>
<html>

<!-- meta contains meta taga, css and fontawesome icons etc -->
@include('common.meta')
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">

<div class="wrapper">
<nav class="main-header navbar navbar-expand navbar-dark navbar-light">
    <!-- header contains top navbar -->
@include('common.header')
<!-- ./end of header -->

    <!-- left sidebar -->
@include('common.sidebar')
<!-- ./end of left sidebar -->

    <!-- dynamic content -->
@yield('content')
<!-- ./end of dynamic content -->

<!-- ./right sidebar -->
    @include('common.footer')
</div>
<!-- ./wrapper -->

<!-- The actual snackbar -->

<!-- all js scripts including custom js -->
@include('common.scripts')
<!-- ./end of js scripts -->

</body>
</html>
