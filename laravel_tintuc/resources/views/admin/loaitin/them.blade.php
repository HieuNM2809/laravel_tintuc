@extends('admin.masterHome')
@section('Content')
      <!-- Page Content -->
      <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Loại Tin
                        <small>Thêm</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
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
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="admin/loaitin/them" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label>Thể loại</label>
                            <select class="form-control" name="idTheLoai">
                                @foreach ($theloai as $tl )
                                  <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tên</label>
                            <input class="form-control" name="Ten" placeholder="Tên loại tin" />
                        </div>
                        <button type="submit" class="btn btn-default">Thêm</button>
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
