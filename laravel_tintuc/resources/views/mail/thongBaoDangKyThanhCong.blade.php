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
            width: 180px;
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
            <img style="width:300px;" 
            src="https://hoithapkhophoctphcm.com/wp-content/uploads/2019/09/dang-ky-thong-tin-thanh-cong-1.png" alt="logo">
        </div>
        <div class="card-body">
            <h2 >Xin chào bạn</h2>
            <h4 class="card-text">
               Chúc mừng bạn đã đăng ký thành công
            </h4>
        </div>
    </div>
    <div class="card text-center" style="margin-bottom: 20px;">
        <div class="card-body">
          <h3 style="color: red;" class="card-title">Thông tin:</h3>
          <h4 class="card-text"><p>User: <i>{{$name}}</i></p></h4>
          <h4 class="card-text"><p>Email: <i>{{$email}}</i> </p></h4>
          <h4 class="card-text"><p>Password: <i>{{$pass}}</i> </p></h4>
        </div>
        
        <div style="margin-top:3px;" class="card-footer text-muted">
            <a target="_blank"  href="{{env('APP_DOMAIN')}}laravel_tintuc/public/dangnhap"  style="color: #fff;" class="btnC">
            Nhấn vào đây để đăng nhập</a>
        </div>
    </div>
    <i>Vui lòng không tiết lộ thông tin này </i>  {{now()}}  
 </body>
</html>