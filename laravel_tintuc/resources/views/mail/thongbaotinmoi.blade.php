<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thông báo</title>
    <style>
        .btnC{
            height: 33px;
            width: 174px;
            text-decoration: none;
            color: #fff;
            background-color: #0069d9;
            border-color: #0062cc;
            display: flex;
            font-weight: 400;
            text-align: center;
            border: 1px solid transparent;
            padding: 10px 5px 0px;
            border-radius: 10.25px;
        }

    </style>
</head>
<body style="margin:10px;>
    <div class="card text-center">
        <div class="card-header">
            <img style="width:300px;" src="https://www.a-star.edu.sg/images/librariesprovider1/default-album/news-and-events/news/astar-news-masthead.jpg" alt="logo">
        </div>
        <div class="card-body">
            <h3 >Xin chào </h3>
            <h4 class="card-text">
                Chúng tôi gửi bạn một bài báo mới nhất hôm nay
            </h4>
        </div>
    </div>
    <div class="card text-center">
        <div class="card-body">
          <h1 class="card-title">Tiêu đề: {{$TieuDe}}</h1>
          <h4 class="card-text"><p>Tóm tắt: {!!$TomTat!!}.</p></h4>
        </div>
        
        <div style="margin-top:3px;" class="card-footer text-muted">
            <a target="_blank"  href="{{$link}}" style="color: #fff;" class="btnC">
            Nhấn vào đây để xem chi tiết</a>
        </div>
    </div>
    {{now()}}
 </body>
</html>