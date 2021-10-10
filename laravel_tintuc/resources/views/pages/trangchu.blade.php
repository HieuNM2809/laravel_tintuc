@extends('masterHome')

@section('Noidung')
    <div class="container">

        <!-- slider -->
        @include('block.slide')
        <!-- end slide -->

        <div class="space20"></div>


        <div class="row main-left">

            @include('block.dsloaitin')
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;" >
                        <h2 style="margin-top:0px; margin-bottom:0px;">Tin hot nhất</h2>
                    </div>
                    <style>
                        .tinhotnhat_img{
                            height: 90%;
                            width: 90%;
                            border-radius:5px;
                            overflow: hidden;
                        }
                        .tinhotnhat_img:hover{
                            transform:scale(1.1);
                            transition: .5s;
                            opacity: .8;
                        }
                    </style>
                    <div class="panel-body">
                        <!-- item -->
                        <div class="col-md-12 border-right">
                            <div class="col-md-8">
                                <a href="tintuc/{{$ghimTin->id}}/{{$ghimTin->TieuDeKhongDau}}.html">
                                    <img class="tinhotnhat_img" class="img-responsive" src="upload/tintuc/{{$ghimTin->Hinh}}" alt="{{$ghimTin->Hinh}}">
                                </a>
                            </div>
            
                            <div class="col-md-4">
                                <h3>{{$ghimTin->TieuDe}}</h3>
                                <p>{!!$ghimTin->TomTat!!}</p>
                                <a class="btn btn-primary" href="tintuc/{{$ghimTin->id}}/{{$ghimTin->TieuDeKhongDau}}.html">Xem chi tiết<span class="glyphicon glyphicon-chevron-right"></span></a>
                            </div>
                        </div>
                        <!-- end item -->
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;" >
                        <h2 style="margin-top:0px; margin-bottom:0px;">Tin tức nổi bật</h2>
                    </div>

                    <div class="panel-body">
                        <!-- item -->
                        @foreach ($theloai as $tl)
                            @if (count($tl->loaitin) > 0)
                                <div class="row-item row">
                                    <h3>
                                        <a >{{$tl->Ten}}</a> |
                                        @foreach ( $tl->loaitin as  $lt)
                                        {{-- 1: đã xóa, 0:chưa xóa --}}
                                            @if ($lt->Xoa == 0)  
                                              <small><a href="loaitin/{{$lt->id}}/{{$lt->TenKhongDau}}.html"><i>{{$lt->Ten}}</i></a>/</small>    
                                            @endif
                                        @endforeach
                                    </h3>
                                    {{-- Lấy 5 bài đầu ( nổi đật và thời gian mới nhất) --}}
                                    <?php
                                        $data5tin = $tl->tintuc->where('NoiBat',1)->sortByDesc('created_at')->take(5);
                                        // shift lấy phần từ đầu tiên, và xóa khỏi mảng
                                        $tin1 = $data5tin->shift();
                                    ?>

                                    <div class="col-md-8 border-right">
                                        <div class="col-md-5">
                                            <a href="tintuc/{{ $tin1->id}}/{{$tin1->TieuDeKhongDau}}.html">
                                                <img style="height: 100%;width: 100%;" class="img-responsive" src="upload/tintuc/{{$tin1->Hinh}}" alt="{{$tin1->Hinh}}">
                                            </a>
                                        </div>

                                        <div class="col-md-7">
                                            <h3>{!!$tin1->TieuDe!!}</h3>
                                            <p>{!!$tin1->TomTat!!}</p>
                                            <a class="btn btn-primary" href="tintuc/{{$tin1->id}}/{{$tin1->TieuDeKhongDau}}.html">Xem chi tiết<span class="glyphicon glyphicon-chevron-right"></span></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        @foreach ( $data5tin as $dt5t )
                                            <a href="tintuc/{{$dt5t->id}}/{{$dt5t->TieuDeKhongDau}}.html">
                                                <h4>
                                                    <span class="glyphicon glyphicon-list-alt"></span>
                                                    {!!$dt5t->TieuDe!!}
                                                 </h4>
                                            </a>
                                        @endforeach
                                    </div>
                                    <div class="break"></div>
                                </div>
                            @endif
                        @endforeach
                        <!-- end item -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection
