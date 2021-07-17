@extends('admin.masterHome')
@section('Content')
     <!-- Page Content -->
     <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin Tức chưa duyệt
                        <small>Danh sách</small>
                    </h1>
                </div>
                {{-- Thông báo kết quả --}}
                @if (session('thongbao'))
                    <div class="alert alert-success">
                        {{ session('thongbao') }}
                    </div>
                @endif
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Tiêu đề</th>
                            <th>Tóm tắt</th>
                            <th>Thể loại</th>
                            <th>Loại tin</th>
                            <th>Nổi bật</th>
                            <th>Ghim</th>
                            <th>Xóa</th>
                            <th>Duyệt</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tintuc as  $tt)
                            <tr class="odd gradeX" align="center">
                                <th>{{$tt->id}}</th>
                                <th>
                                     <h4>{{$tt->TieuDe}}</h4>
                                    {{-- thêm hình --}}
                                    <img width="100%" src="upload/tintuc/{{$tt->Hinh}}" alt="hinh{{$tt->id}}">
                                </th>
                                {{-- <th>{{$tt->TieuDeKhongDau}}</th> --}}
                                <th>{{$tt->TomTat}}</th>
                                <th>{{$tt->loaitin->theloai->Ten}}</th>
                                <th>{{$tt->loaitin->Ten}}</th>
                                <th>
                                    {{ ($tt->NoiBat == 1)?"Có":"Không"}}
                                </th>
                                <th> {{ $tt->ghimTin}}</th>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/tintuc/xoa/{{$tt->id}}"> Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tintuc/duyettintuc/{{$tt->id}}">Duyệt</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection