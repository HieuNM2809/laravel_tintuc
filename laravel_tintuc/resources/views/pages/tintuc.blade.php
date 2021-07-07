@extends('masterHome')
@section('Noidung')
<div class="container">
    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-9">

            <!-- Blog Post -->

            <!-- Title -->
            <h1>{{$tintuc->TieuDe}}</h1>

            Chia sẻ :
            {{-- chia se zalo --}}
            <div class="zalo-share-button"  data-href="" data-oaid="579745863508352884" data-layout="2" data-color="blue" data-customize=false></div>
            {{-- chia sẻ facebook --}}
            <div class="fb-share-button"
                     data-href="<?php echo '/tintuc/'.$tintuc->id.'/'.$tintuc->TieuDeKhongDau.'.html' ?>" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
            <!-- Author -->
            <p class="lead">
                bởi <a >Nguyễn Minh Hiếu</a>
            </p>

            <!-- Preview Image -->
            <img style="width:50%" class="img-responsive " src="upload/tintuc/{{$tintuc->Hinh}}" alt="{{$tintuc->Hinh}}">

            <!-- Date/Time -->
            <p style="margin-top: 10px"><span class="glyphicon glyphicon-time"></span> Đăng ngày {{$tintuc->created_at}} giờ</p>
            <hr>

            <!-- Post Content -->
            <p>{!!$tintuc->NoiDung!!}</p>
            <hr>

            <!-- Blog Comments -->

            <!-- Comments Form -->
            @if (isset($user_login))
                <div class="well">
                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                    {{-- <form action="comment" role="form" method="post">
                        @csrf
                        @method('post')
                        <div class="form-group">
                            <textarea class="form-control" name="txtComment" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </form> --}}
                    <div>
                        <div class="form-group">
                            <p id="idTinTuc" style="display: none">{{$tintuc->id}}</p>
                            <textarea id="txtComment" class="form-control" name="txtComment" rows="3"></textarea>
                        </div>
                        <button  id="btnComment" type="button" class="btn btn-primary">Gửi</button>
                    </div>
                </div>
            @endif
            

            <hr>
            <h2>Danh sách bình luận</h2>
            <!-- Posted Comments -->
            <?php  
            // xep binh luan lai 
            $ttComment = $tintuc->comment->sortByDesc('id')->take(5);
            ?>
           <div id="lstCom">
                @if(count($ttComment)> 0 )
                    @foreach ($ttComment as  $cm)
                        <!-- Comment -->
                        <div class="media">
                            <a class="pull-left" >
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">
                                {{ $cm->user->name}}
                                    <small>Ngày {{$cm->created_at}} giờ</small>
                                </h4>
                                {{$cm->NoiDung}}
                            </div>
                        </div>
                    @endforeach
                @else
                    <div style="text-align: center;font-size: 20px">Chưa có bình luận nào !!!!</div>       
                @endif
           </div>
                    
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin liên quan</b></div>
                <div class="panel-body " >
                    @foreach ($tinlienquan as  $tlq)
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="tintuc/{{$tlq->id}}/{{$tlq->TieuDeKhongDau}}.html">
                                    <img class="img-responsive" src="upload/tintuc/{{$tlq->Hinh}}" alt="{{$tlq->Hinh}}">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="tintuc/{{$tlq->id}}/{{$tlq->TieuDeKhongDau}}.html"><b>{{$tlq->TieuDe}}</b></a>
                            </div>
                            <div style="padding: 10px">
                                {!!$tlq->TomTat!!}
                            </div>
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                    @endforeach
                    
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin nổi bật</b></div>
                <div class="panel-body">

                    @foreach ($tinnoibat as  $tnb)
                    <!-- item -->
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-5">
                            <a href="tintuc/{{$tnb->id}}/{{$tnb->TieuDeKhongDau}}.html">
                                <img class="img-responsive" src="upload/tintuc/{{$tnb->Hinh}}" alt="{{$tnb->Hinh}}">
                            </a>
                        </div>
                        <div class="col-md-7">
                            <a href="tintuc/{{$tnb->id}}/{{$tnb->TieuDeKhongDau}}.html"><b>{{$tnb->TieuDe}}</b></a>
                        </div>
                        <div style="padding: 10px">
                            {!!$tnb->TomTat!!}
                        </div>
                        <div class="break"></div>
                    </div>
                    <!-- end item -->
                @endforeach
                </div>
            </div>
            
        </div>

    </div>
    <!-- /.row -->
</div>
@endsection
@section('script')
     <script>
        $(document).ready(function(){
              $('#btnComment').click(function(){
                  const xhttp = new XMLHttpRequest();
                  xhttp.onreadystatechange = function() {
                      if (this.readyState == 4 && this.status == 200) {
                      document.getElementById("lstCom").innerHTML =
                      this.responseText;
                    }
                  };
                  var url ="comment/" + $("#idTinTuc").text() + "/" + $("#txtComment").val();

                  xhttp.open("GET", url);
                  xhttp.send();
                  $("#txtComment").val('');
              });
        });
    </script>
@endsection