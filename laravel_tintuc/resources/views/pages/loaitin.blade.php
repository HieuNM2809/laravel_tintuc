@extends('masterHome')

@section('Noidung')
    <div class="container">
        <div class="space20"></div>
        <div class="row main-left">

            @include('block.dsloaitin')

            <div class="col-md-9 ">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h4><b>{{$loaitin->Ten}}</b></h4>
                    </div>
                    @foreach ($tintuc as  $tt)
                        <div class="row-item row">
                            <div class="col-md-3">

                                <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">
                                    <br>
                                    <img width="200px" height="200px" class="img-responsive" src="upload/tintuc/{{$tt->Hinh}}" alt="{{$tt->Hinh}}">
                                </a>
                            </div>

                            <div class="col-md-9">
                                <h3>{{$tt->TieuDe}}</h3>
                                <p>{!!$tt->TomTat!!}</p>
                                <a class="btn btn-primary" href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">Xem thêm<span class="glyphicon glyphicon-chevron-right"></span></a>
                            </div>
                            <div class="break"></div>
                        </div>
                    @endforeach

                    <style>
                        .flex ,.items-center ,.justify-between{
                            text-align: center;
                            padding: 20px 0;
                            font-size: 20px;
                            justify-content:space-evenly;
                        }
                        .flex > *{
                            padding: 0 20px;
                            cursor: pointer;
                        }
                        .flex > span{
                           cursor:no-drop;
                        }
                    </style>
                    <!-- Pagination -->
                    {{ $tintuc->links() }}
                    {{-- <div class="row text-center">
                        <div class="col-lg-12">
                            <ul class="pagination">
                                <li>
                                    <a href="#">&laquo;</a>
                                </li>
                                <li class="active">
                                    <a href="#">1</a>
                                </li>
                                <li>
                                    <a href="#">2</a>
                                </li>
                                <li>
                                    <a href="#">3</a>
                                </li>
                                <li>
                                    <a href="#">4</a>
                                </li>
                                <li>
                                    <a href="#">5</a>
                                </li>
                                <li>
                                    <a href="#">&raquo;</a>
                                </li>
                            </ul>
                        </div>
                    </div> --}}
                    <!-- /.row -->

                </div>
            </div>


        </div>
        <!-- /.row -->
    </div>
@endsection
