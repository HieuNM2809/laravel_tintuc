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
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Liên hệ</h2>
	            	</div>

	            	<div class="panel-body">
	            		<!-- item -->
                        <h3><span class="glyphicon glyphicon-align-left"></span> Thông tin liên hệ</h3>

                        <div class="break"></div>
					   	<h4><span class= "glyphicon glyphicon-home "></span> Địa chỉ : </h4>
                        <p>71, Nguyễn Phúc Chu, P.15, Q. Tân Bình, TP HCM </p>

                        <h4><span class="glyphicon glyphicon-envelope"></span> Email : </h4>
                        <p>nguyenminhhieu28092001k3@gmail.com</p>

                        <h4><span class="glyphicon glyphicon-phone-alt"></span> Điện thoại : </h4>
                        <p>0799501324</p>



                        <br><br>
                        <h3><span class="glyphicon glyphicon-globe"></span> Bản đồ</h3>
                        <div class="break"></div><br>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.8553183027584!2d106.63064421410392!3d10.82238219229035!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752963a58b946d%3A0x6e82cafa97180875!2zNzEgTmd1eeG7hW4gUGjDumMgQ2h1LCBQaMaw4budbmcgMTUsIFTDom4gQsOsbmgsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmlldG5hbQ!5e0!3m2!1sfr!2s!4v1625214261203!5m2!1sfr!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
@endsection
