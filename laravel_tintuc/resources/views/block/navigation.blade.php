<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <style>
                .logo{
                    width: 168px; height: 42px; position: relative;top: -8px;
                }
                .logo:hover{
                    opacity: 80%;
                }
            </style>
            <a class="navbar-brand" href="trangchu">
                <img class="logo"   src="upload/logo.png" alt="logo">
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="gioithieu">Giới thiệu</a>
                </li>
                <li>
                    <a href="lienhe">Liên hệ</a>
                </li>
            </ul>

            <form action="timkiem" method="get" class="navbar-form navbar-left" role="search">
                <div class="form-group">
                  <input type="text" name="key" class="form-control" placeholder="Nội dung tìm kiếm">
                </div>
                <button type="submit"  class="btn btn-default">Tìm kiếm</button>
            </form>

            <ul class="nav navbar-nav pull-right">
                @if(!isset($user_login))
                    <li>
                        <a href="dangky">Đăng ký</a>
                    </li>
                    <li>
                        <a href="dangnhap">Đăng nhập</a>
                    </li>
                 @else    
                    <li>
                        <a href="nguoidung">
                            <span class ="glyphicon glyphicon-user"></span>
                           {{$user_login->name}}
                        </a>
                    </li>

                    <li>
                        <a href="dangxuat">Đăng xuất</a>
                    </li>
                 @endif   

            </ul>
        </div>



        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
