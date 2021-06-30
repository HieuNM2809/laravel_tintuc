@extends('admin.masterHome')
@section('Content')
      <!-- Page Content -->
      <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Slide
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
                    <form action="admin/slide/sua/{{$slide->id}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label>Tên</label>
                            <input class="form-control" name="Ten" value="{{$slide->Ten}}" placeholder="Tên slide" />
                        </div>
                        <div class="form-group">
                            <img width="300px" src="upload/slide/{{$slide->Hinh}}" alt="{{$slide->Hinh}}">
                        </div>
                        <div class="form-group">
                            <label>Hình</label>
                            <input type="file" class="form-control" name="Hinh" />
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea id="demo"  name="NoiDung"   class="form-control ckeditor" rows="3">
                              {{$slide->NoiDung}}
                             </textarea>
                        </div>
                        <div class="form-group">
                            <label>Link</label>
                            <input class="form-control" value="{{$slide->link}}" name="link" placeholder="Link slide" />
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
