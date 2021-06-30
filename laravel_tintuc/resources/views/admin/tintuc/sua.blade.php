@extends('admin.masterHome')
@section('Content')
      <!-- Page Content -->
      <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin tức
                        <small>Sửa</small>
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
                    <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label>Thể loại</label>
                            <select class="form-control" name="idTheLoai" id="idTheLoai">
                                @foreach ($theloai as $tl )
                                  <option
                                  @if($tintuc->loaitin->idTheLoai == $tl->id) {{' selected '}} @endif
                                  value="{{$tl->id}}">{{$tl->Ten}}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Loại tin</label>
                            <select class="form-control" name=" idLoaiTin" id="idLoaiTin">
                                @foreach ($loaitin as $lt )
                                   <option
                                   @if($tintuc->loaitin->id == $lt->id) {{' selected '}} @endif
                                   value="{{$lt->id}}">{{$lt->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input class="form-control" value="{{$tintuc->TieuDe}}" name="TieuDe" value="{{old('TieuDe')}}" placeholder="Nhập điêu đề" />
                        </div>
                        <div class="form-group">
                            <label>Tóm tắt</label>
                            <textarea id="demo"  name="TomTat"  class="form-control ckeditor" rows="3">
                               {{$tintuc->TomTat}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea id="demo" name="NoiDung"  class="form-control ckeditor" rows="3">
                                {{$tintuc->NoiDung}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <img width="200px" src="upload/tintuc/{{$tintuc->Hinh}}" alt="{{$tintuc->Hinh}}">
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" class="form-control" name="Hinh" />
                        </div>
                        <div class="form-group">
                            <label>Nổi bật</label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="1"
                                @if($tintuc->NoiBat == 1) {{' checked '}} @endif
                                type="radio">Có
                            </label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="0"
                                @if($tintuc->NoiBat == 0) {{' checked '}} @endif
                                type="radio">Không
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Sửa</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                    <form>
                </div>
            </div>
            <!-- /.row -->
            {{-- bình luận --}}
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Bình luận
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    {{-- Thông báo kết quả --}}
                    @if (session('thongbaoCom'))
                        <div class="alert alert-success">
                            {{ session('thongbaoCom') }}
                        </div>
                    @endif
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Nội dung</th>
                                <th>Ngày đăng</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tintuc->comment as  $cm)
                                <tr class="odd gradeX" align="center">
                                    <th>{{$cm->id}}</th>
                                    <th>{{$cm->user->name}}</th>
                                    <th>{{$cm->NoiDung}}</th>
                                    <th>{{$cm->created_at}}</th>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$cm->id}}/{{$tintuc->id}}"> Xóa</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
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
