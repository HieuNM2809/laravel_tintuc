<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Khóa Học Lập Trình Laravel Framework 5.x Tại Khoa Phạm">
    <meta name="author" content="">

    <title>Admin - Login</title>

    <!-- Bootstrap Core CSS -->
    <base href="{{URL::asset('/')}}" target="_top">

    <link href="asset_admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="asset_admin/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="asset_admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="asset_admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style>
        a:hover, a:focus {
            color: #23527c;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Vui lòng đăng nhập</h3>
                    </div>
                    <div class="panel-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                         {{-- Thông báo kết quả --}}
                        @if (session('thongbao'))
                            <div class="alert alert-success">
                                {{ session('thongbao') }}
                            </div>
                        @endif
                        {{-- Thông báo về trang chủ --}}
                        @if (session('veTrangChu'))
                            <div class="alert alert-success">
                                <a href="trangchu">
                                    <button type="button" class="btn btn-lg btn-danger btn-block">
                                        {{ session('veTrangChu') }}
                                    </button>
                                </a>
                            </div>
                           
                        @endif
                        <form role="form" action="admin/login" method="POST">
                            @csrf
                            @method('POST')
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" value="{{old('email')}}" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="asset_admin/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="asset_admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="asset_admin/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="asset_admin/dist/js/sb-admin-2.js"></script>

</body>

</html>
