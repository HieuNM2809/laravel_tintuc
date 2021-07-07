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
				  	<div class="panel-heading">Sửa tài khoản</div>
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
				    	<form action="nguoidung"  method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" value="{{$nguoidung->name}}" name="name" placeholder="Nhập tên user" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" readonly name="email" value="{{$nguoidung->email}}" placeholder="Nhập email" />
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="changePassword" id="changePassword">
                                <label for="chargePassword">Đổi Password</label>
                                <input type="password" disabled="" class="form-control pass" name="password" placeholder="Password" />
                            </div>
                            <div class="form-group">
                                <label>Nhập lại Password</label>
                                <input  type="password" disabled="" class="form-control pass"  name="passwordAgain" placeholder="Nhập lại Password" />
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
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
@section('script')
    <script>
        $(document).ready(function(){
            $('#changePassword').change(function(){
                if($(this).is(":checked")){
                    $('.pass').removeAttr('disabled');
                }else{
                    $('.pass').attr('disabled',"")
                }
            });
        });
    </script>
@endsection