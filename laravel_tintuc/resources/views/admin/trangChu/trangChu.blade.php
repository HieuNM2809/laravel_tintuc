@extends('admin.masterHome')
@section('Content')
     <!-- Page Content -->
     <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Trang chủ
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                 {{-- xuat loi --}}
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
                <div class="col-lg-12" >
                    <div class="row mr-3">
                        <div class="col-lg-12 ">
                            <div class="trangchu__chart-title">
                                Thống kê tháng {{date('m - Y',strtotime(now()));}}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="box" style="border-left: .25rem solid #1cc88a">
                                <div class="box_text">
                                    <div class="box_title" style="color: #1cc88a">sỐ LƯỢNG PHẢN HỒI</div>
                                    <div class="box_parameter">{{$soLuongPhanHoi}}</div>
                                </div>
                                <div class="box_icon">
                                    <i class="fa fa-bug fa-fw"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="box">
                                <div class="box_text">
                                    <div class="box_title" style="color: #4e73df;">TỔNG SỐ LƯỢT XEM BÀI VIẾT</div>
                                    <div class="box_parameter">{{$soLuongLuotXem}}</div>
                                </div>
                                <div class="box_icon">
                                    <i class="fa fa-eye fa-fw"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="box" style="border-left: .25rem solid #36b9cc">
                                <div class="box_text">
                                    <div class="box_title" style="color: #36b9cc">SỐ LƯỢNG COMMENTS</div>
                                    <div class="box_parameter">{{$soLuongComment}}</div>
                                </div>
                                <div class="box_icon">
                                    <i class="fa fa-comments fa-fw"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="box">
                                <div class="box_text">
                                    <div class="box_title">NGƯỜI ĐĂNG KÝ MỚI</div>
                                    <div class="box_parameter">{{$soLuongDangKy}}</div>
                                </div>
                                <div class="box_icon">
                                    <i class="fa fa-user fa-fw"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mr-3">
                        <div class="col-lg-12 ">
                            <div class="trangchu__chart-title">
                                Thống kê ngày {{date('d - m - Y',strtotime(now()));}}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="box" style="border-left: .25rem solid #1cc88a">
                                <div class="box_text">
                                    <div class="box_title" style="color: #1cc88a">sỐ LƯỢNG PHẢN HỒI</div>
                                    <div class="box_parameter">{{$soLuongPhanHoiTheoNgay}}</div>
                                </div>
                                <div class="box_icon">
                                    <i class="fa fa-bug fa-fw"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="box">
                                <div class="box_text">
                                    <div class="box_title" style="color: #4e73df;">TỔNG SỐ LƯỢT XEM BÀI VIẾT</div>
                                    <div class="box_parameter">{{$soLuongLuotXemTheoNgay}}</div>
                                </div>
                                <div class="box_icon">
                                    <i class="fa fa-eye fa-fw"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="box" style="border-left: .25rem solid #36b9cc">
                                <div class="box_text">
                                    <div class="box_title" style="color: #36b9cc">SỐ LƯỢNG COMMENTS</div>
                                    <div class="box_parameter">{{$soLuongCommentTheoNgay}}</div>
                                </div>
                                <div class="box_icon">
                                    <i class="fa fa-comments fa-fw"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="box">
                                <div class="box_text">
                                    <div class="box_title">NGƯỜI ĐĂNG KÝ MỚI</div>
                                    <div class="box_parameter">{{$soLuongDangKyTheoNgay}}</div>
                                </div>
                                <div class="box_icon">
                                    <i class="fa fa-user fa-fw"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="trangchu__info">
                        <div class="trangchu__info-title">
                            Giới thiệu 
                        </div>
                        <div class="trangchu__info-img">
                            <img src="asset_admin/img/biaDashboard1.png" alt="biaTrangChu">
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

@endsection
