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
        <img class="logo" src="https://hoithapkhophoctphcm.com/wp-content/uploads/2019/09/dang-ky-thong-tin-thanh-cong-1.png" alt="logo">

        <!-- Card 1 -->
        <div class="card">
            <h2>Xin chào bạn</h2>
            <p>Chúc mừng bạn đã đăng ký thành công.</p>
        </div>

        <!-- Card 2 -->
        <div class="card">
            <h3 style="color: red;">Thông tin:</h3>
            <p>User: <i>{{$name}}</i></p>
            <p>Email: <i>{{$email}}</i></p>
            <p>Password: <i>{{$pass}}</i></p>
            <div class="footer">
                <a target="_blank" href="{{env('APP_DOMAIN')}}laravel_tintuc/public/dangnhap" class="btn">Nhấn vào đây để đăng nhập</a>
            </div>
        </div>

        <!-- Disclaimer -->
        <p><i>Vui lòng không tiết lộ thông tin này.</i></p>

        <!-- Timestamp -->
        <p>{{now()}}</p>
    </div>
</body>
</html>
