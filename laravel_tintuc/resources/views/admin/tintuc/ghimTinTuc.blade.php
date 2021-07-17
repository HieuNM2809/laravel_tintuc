@extends('admin.masterHome')
@section('Content')
     <!-- Page Content -->
     <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin tức
                        <small>Ghim</small>
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
                    <form action="admin/tintuc/ghim/them" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" id="timkiem" autocomplete="off" placeholder="Tìm kiếm theo ID, tiêu đề...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div> <br/>
                            <label>Tin tức</label>
                            <select class="form-control" name="tintuc" id="tintuc">
                                @foreach ($tintuc as $tt )
                                  <option value="{{$tt->id}}">{{$tt->TieuDe}}</option>
                                @endforeach
                            </select>
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
            $('#timkiem').change(function(){
                const xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    //alert(this.responseText);
                    if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("tintuc").innerHTML =
                    this.responseText;
                    }
                };
                var url ="admin/tintuc/ajaxTinTuc/"+$('#timkiem').val();
                xhttp.open("GET", url);
                xhttp.send();
            });
      });
  </script>
@endsection
