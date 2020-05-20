<!doctype html>
<html lang="en">
<head>
    <x-head/>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
{{--    <div style="width: 700px;" class="container">--}}
{{--        <div class="form">--}}
{{--            <x-header/>--}}
{{--            <div class="form-content">--}}
{{--                @yield("content")--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="wrapper">

    <!-- /.navbar -->
    <x-nav/>
    <!-- Main Sidebar Container -->
    <x-aside/>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <x-contentHeader/>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield("content")
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <x-footer/>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<x-scripts/>
</body>
</html>
