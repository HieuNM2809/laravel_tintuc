@extends('masterHome')
@section('Noidung')
      <!-- Page Content -->
      <div class="container">

    	<!-- slider -->
    	@include('block.slide')
        <!-- end slide -->

        <div class="space20"></div>


        <div class="row main-left">
            @include('block.dsloaitin')

            <div class="col-md-9">
	            <div class="panel panel-default">
	            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Giới thiệu</h2>
	            	</div>

	            	<div class="panel-body">
	            		<!-- item -->
					   <p>
                        HM tin tức là một trang web tổng hợp tin tức tự động từ ~100 báo điện tử ở Việt Nam[1]. Trong đó có các nguồn báo nổi tiếng như: thanhnien.vn, tienphong.vn, vov.vn, vtc.vn và còn rất nhiều tờ báo khác...

                        Ngày 21/12/2019, Google đã loại bỏ HM tin tức ra khỏi tất cả kết quả tìm kiếm.[2] Sau đó 3 ngày, các kết quả tìm kiếm được phục hồi.
                        HM tin tức ra đời ngày 15/09/2005 trên hai địa chỉ hmtintuc.com và hmtintuc.vn và được bộ Văn hóa Thông tin cấp giấy phép chính thức hoạt động ngày 15/12/2006.

                        HM tin tức ra mắt phiên bản mới trên hmtintuc.vn ngày 15/09/2007 với giao diện tương tự Digg cho phép người sử dụng đánh giá tin tức và tự tạo chuyên mục.

                        Phiên bản hợp nhất của hmtintuc.com và hmtintuc.vn đã ra mắt vào ngày 03/03/2009.

                        Năm 2012, hmtintuc.com bị mua lại bởi tập đoàn game online số 1 Việt Nam VNG.

                        Tính đến tháng 12/2019 hmtintuc.com nằm trong Top 30 trang web hàng đầu Việt Nam theo Alexa[3].
                       </p>

					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
@endsection
