<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta name="description" content="Khóa Học Lập Trình Laravel Framework 5.x Tại Khoa Phạm"> --}}
    <meta name="author" content="">
    <title>Admin - Tin tức</title>

    {{-- khởi tại đường đẫn mặc định ở public  --}}
    <base href="{{URL::asset('/')}}" target="_top">
    <!-- Bootstrap Core CSS -->

    <link href="asset_admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="asset_admin/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="asset_admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="asset_admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="asset_admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="asset_admin/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- input text css -->
    <script type="text/javascript" language="javascript" src="asset_admin/ckeditor/ckeditor.js" ></script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
         @include('admin.block.navigation')

        <!-- Page Content -->
         @yield('Content')
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="asset_admin/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="asset_admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="asset_admin/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="asset_admin/dist/js/sb-admin-2.js"></script>

    <!-- DataTables JavaScript -->
    <script src="asset_admin/bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script src="asset_admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
    @yield('script')
</body>

</html>
