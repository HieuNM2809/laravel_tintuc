<div class="row carousel-holder">
    <div class="col-md-12">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php  $stt = 0; ?>
                @foreach ($slide as $sl )
                    <li data-target="#carousel-example-generic" data-slide-to="{{$stt}}"
                   @if ( $stt == 0)
                        class="active"
                   @endif
                    ></li>
                    <?php  $stt++ ; ?>
                @endforeach
            </ol>
            <div class="carousel-inner">
                <?php $check =1; ?>
                @foreach ($slide as  $sl)
                    @if($check == 1)
                        <div class="item active">
                            <img  class="slide-image" src="upload/slide/{{$sl->Hinh}}" alt="$sl->Hinh">
                        </div>
                        <?php $check ++; ?>
                    @else
                        <div class="item ">
                            <img  class="slide-image" src="upload/slide/{{$sl->Hinh}}" alt="$sl->Hinh">
                        </div>
                    @endif
                @endforeach
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
    </div>
</div>
