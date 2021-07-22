<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Trang chủ</title>
    
    <link rel="shortcut icon" href="favicon-32x32.png" type="image/x-icon">

    {{--  lay duong dan tu public  --}}
    <base href="{{asset('/')}}">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Font CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- link developers zalo -->
    <script src="https://sp.zalo.me/plugins/sdk.js"></script>

    <!-- link ckeditor -->
    {{-- ckediter Full Package --}}
    {{-- <script type="text/javascript" language="javascript" src="asset_admin/ckeditor/ckeditor.js" ></script> --}}
    
    {{-- ckediter Basic Package --}}
    <script src="//cdn.ckeditor.com/4.16.1/basic/ckeditor.js"></script>

    {{-- recaptcha --}}
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>

<body >
     {{-- share facebook --}}
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v11.0" nonce="3RCUqZ1S"></script>
    

    @if(isset($user_login))
            {{-- nhắn tin trực tuyến zalo --}}
        <div class="zalo-chat-widget" data-oaid="579745863508352884" data-welcome-message="Rất vui khi được hỗ trợ bạn!" data-autopopup="0" data-width="300" data-height="300"></div>
        
        {{-- Nhắn tin facebook --}}
        <!-- Messenger Chat plugin Code -->
        <div id="fb-root"></div>

        <!-- Your Chat plugin code -->
        <div id="fb-customer-chat" class="fb-customerchat">
        </div>

        <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "104377968584203");
        chatbox.setAttribute("attribution", "biz_inbox");

        window.fbAsyncInit = function() {
            FB.init({
            xfbml            : true,
            version          : 'v11.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        </script>
    @endif 




    <!-- Navigation -->
    @include('block.navigation')

    <!-- Page Content -->
    @yield('Noidung')
    <!-- end Page Content -->

    <!-- Footer -->
    @include('block.footer')
    <!-- end Footer -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/my.js"></script>
     @yield('script')
</body>

</html>
