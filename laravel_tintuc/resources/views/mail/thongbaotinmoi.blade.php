<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thông báo</title>
    <style>
        /* Reset styles */
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        /* Container */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Logo */
        .logo {
            display: block;
            margin: 0 auto;
            max-width: 100%;
            height: auto;
        }

        /* Card styles */
        .card {
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 20px;
        }

        /* Button styles */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            background-color: #0069d9;
            border-radius: 5px;
        }

        /* Header styles */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Footer styles */
        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logo -->
        <img class="logo" src="https://www.a-star.edu.sg/images/librariesprovider1/default-album/news-and-events/news/astar-news-masthead.jpg" alt="logo">

        <!-- Card 1 -->
        <div class="card">
            <h3>Xin chào</h3>
            <p>Chúng tôi gửi bạn một bài báo mới nhất hôm nay.</p>
        </div>

        <!-- Card 2 -->
        <div class="card">
            <h1>Tiêu đề: {{$TieuDe}}</h1>
            <p>Tóm tắt: {!!$TomTat!!}.</p>
            <div class="footer">
                <a target="_blank" style="color: #fff;" href="{{$link}}" class="btn">Nhấn vào đây để xem chi tiết</a>
            </div>
        </div>

        <!-- Timestamp -->
        <p>{{now()}}</p>
    </div>
</body>
</html>
