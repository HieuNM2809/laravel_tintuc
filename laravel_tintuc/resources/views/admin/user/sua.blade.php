@extends('admin.masterHome')
@section('Content')
      <!-- Page Content -->
      <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>Sửa</small>
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
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="admin/user/sua/{{$user->id}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label>Tên</label>
                            <input class="form-control" value="{{$user->name}}" name="name" placeholder="Nhập tên user" />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" readonly name="email" value="{{$user->email}}" placeholder="Nhập email" />
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
                        <div class="form-group">
                            <label>Vai trò</label>
                            <label class="radio-inline">
                                <input name="role" value="0"
                                @if ($user->role == 0)
                                    {{' checked '}}
                                @endif
                                type="radio">Người dùng
                            </label>
                            <label class="radio-inline">
                                <input name="role"
                                @if ($user->role == 1)
                                        {{' checked '}}
                                @endif
                                 value="1" type="radio">Admin
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Sửa</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                    <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
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
