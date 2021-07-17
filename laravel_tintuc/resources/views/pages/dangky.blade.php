@extends('masterHome')
@section('Noidung')
    <!-- Page Content -->
    <div class="container" style="margin-top: 20px">
    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
				  	<div class="panel-heading">Đăng ký tài khoản</div>
                      {{-- thong bao loi --}}
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
				  	<div class="panel-body">
				    	<form action="dangky"  method="post">
                            @csrf
                            @method('POST')
				    		<div>
				    			<label>Họ tên</label>
							  	<input type="text" class="form-control" placeholder="Tên"  name="name" value="{{old('name')}}" aria-describedby="basic-addon1">
							</div>
							<br>
							<div>
				    			<label>Email</label>
							  	<input type="email" class="form-control" placeholder="Email" value="{{old('email')}}" name="email" aria-describedby="basic-addon1"
							  	>
							</div>
							<br>	
							<div>
				    			<label>Nhập mật khẩu</label>
							  	<input type="password" class="form-control" placeholder="Mật khẩu" name="password" aria-describedby="basic-addon1">
							</div>
							<br>
							<div>
				    			<label>Nhập lại mật khẩu</label>
							  	<input type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="passwordAgain" aria-describedby="basic-addon1">
							</div>
                            <div style="margin-top:5px;">
                                   {{-- recaptcha --}}
                                   <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                                     {{-- thong bao --}}
                                    {{-- @if ($errors->has('g-recaptcha-response'))
                                        <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                                    @endif --}}
                            </div>
							<br>
							<button type="submit" class="btn btn-default">Đăng ký
							</button>

				    	</form>
				  	</div>
				</div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>
    <!-- end Page Content -->
@endsection