@extends('admin.masterHome')
@section('Content')
      <!-- Page Content -->
      <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thể loại
                        <small>{{$theloai->Ten}}</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                    {{-- thông báo lỗi khi nhập --}}
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
                    <form action="admin/theloai/sua/{{$theloai->id}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label>Tên</label>
                            <input class="form-control" value="{{$theloai->Ten}}" name="Ten" placeholder="Tên thể loại" />
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
