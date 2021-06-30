@extends('admin.masterHome')
@section('Content')
      <!-- Page Content -->
      <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin tức
                        <small>Thêm</small>
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
                    <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label>Thể loại</label>
                            <select class="form-control" name="idTheLoai" id="idTheLoai">
                                @foreach ($theloai as $tl )
                                  <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Loại tin</label>
                            <select class="form-control" name=" idLoaiTin" id="idLoaiTin">
                                @foreach ($loaitin as $lt )
                                   <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input class="form-control" name="TieuDe" value="{{old('TieuDe')}}" placeholder="Nhập điêu đề" />
                        </div>
                        <div class="form-group">
                            <label>Tóm tắt</label>
                            <textarea id="demo"  name="TomTat" value="{{old('TomTat')}}" class="form-control ckeditor" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea id="demo" name="NoiDung" value="{{old('NoiDung')}}" class="form-control ckeditor" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" class="form-control" name="Hinh" />
                        </div>
                        <div class="form-group">
                            <label>Nổi bật</label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="1" checked type="radio">Có
                            </label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="0" type="radio">Không
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Thêm</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                    <form>
                </div>
            </div>
            <!-- /.row -->
            {{-- bình luận --}}

            <!-- /.table -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection


@section('script')
  <script>
      $(document).ready(function(){
            $('#idTheLoai').change(function(){
                const xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    //alert(this.responseText);
                    if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("idLoaiTin").innerHTML =
                    this.responseText;
                    }
                };
                var url ="admin/tintuc/ajax/"+$('#idTheLoai').val();
                xhttp.open("GET", url);
                xhttp.send();
            });
      });
  </script>
@endsection
