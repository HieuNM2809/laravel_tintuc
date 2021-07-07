<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="admin/theloai/danhsach">Admin - Tin tức</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
           @if(isset($user_login_admin))
            <a class="dropdown-toggle" data-toggle="dropdown" >
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a ><i class="fa fa-user fa-fw"></i>{{$user_login_admin->name}}</a>
                </li>
                <li><a href="admin/user/sua/{{$user_login_admin->id}}"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="admin/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
           @endif
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                    <!-- /input-group -->
                </li>
                <li>
                    <a href="admin/mail/them"><i class="fa fa-paper-plane fa-fw"></i> Gửi mail quảng cáo</a>
                </li>
                <li>
                    <a href="admin/theloai/danhsach"><i class="fa fa-bar-chart-o fa-fw"></i> Thể loại<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="admin/theloai/danhsach">Danh sách</a>
                        </li>
                        <li>
                            <a href="admin/theloai/them">Thêm</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="admin/loaitin/danhsach"><i class="fa fa-bar-chart-o fa-fw"></i>Loại tin<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="admin/loaitin/danhsach">Danh sách</a>
                        </li>
                        <li>
                            <a href="admin/loaitin/them">Thêm</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="admin/tintuc/danhsach"><i class="fa fa-bar-chart-o fa-fw"></i>Tin tức<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="admin/tintuc/danhsach">Danh sách</a>
                        </li>
                        <li>
                            <a href="admin/tintuc/them">Thêm</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="admin/slide/danhsach"><i class="fa fa-bar-chart-o fa-fw"></i>Slide<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="admin/slide/danhsach">Danh sách</a>
                        </li>
                        <li>
                            <a href="admin/slide/them">Thêm</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                {{-- <li>
                    <a href="#"><i class="fa fa-cube fa-fw"></i> Product<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#">List Product</a>
                        </li>
                        <li>
                            <a href="#">Add Product</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li> --}}
                <li>
                    <a href="admin/user/danhsach"><i class="fa fa-users fa-fw"></i>User<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="admin/user/danhsach">Danh sách</a>
                        </li>
                        <li>
                            <a href="admin/user/them">Thêm</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
