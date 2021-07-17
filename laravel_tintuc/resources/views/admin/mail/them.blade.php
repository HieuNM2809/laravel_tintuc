@extends('admin.masterHome')
@section('Content')
      <!-- Page Content -->
      <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Mail
                        <small>gửi</small>
                    </h1>
                </div>
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
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="admin/mail/them" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input class="form-control" name="TieuDe"    value="{{old('TieuDe')}}" placeholder="Tiêu đề" />
                        </div>
                        <div class="form-group">
                            <label>Tóm tắt</label>
                            <textarea id="demo"  name="TomTat"   class="form-control ckeditor" rows="3">
                                {{old('TomTat')}}
                             </textarea>
                        </div>
                        <div class="form-group">
                            <label>Link</label>
                            <input class="form-control"    value="{{old('link')}}" name="link" placeholder="Link" />
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="nhapTaiKhoan" id="nhapTaiKhoan">
                            <label for="nhapTaiKhoan">Nhập tài khoản gửi</label>
                            <br/> <i style="color: red">Nhập nhiều tài khoản email cách nhau bằng dấu phẩy</i>
                            <input type="text" disabled="" class="form-control" id="taikhoan" name="taiKhoan" placeholder="Tài khoản bạn muốn gửi" />
                        </div>
                        <button type="submit" class="btn btn-default">Gửi</button>
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
            $('#nhapTaiKhoan').change(function(){
                if($(this).is(":checked")){
                    $('#taikhoan').removeAttr('disabled');
                }else{
                    $('#taikhoan').attr('disabled',"")
                }
            });
        });
    </script>
@endsection
