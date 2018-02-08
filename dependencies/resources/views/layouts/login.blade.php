<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>ระบบหลังบ้าน |
        <?php
        $title = \App\General::first();
        echo $title->translateDefault()->title;
        ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <link rel="apple-touch-icon" href="{{asset('/admin-assets/pages/ico/60.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('/admin-assets/pages/ico/76.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('/admin-assets/pages/ico/120.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('/admin-assets/pages/ico/152.png')}}">
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="Library of Hotel Booking System developed by Degito team" name="description" />
    <meta content="Blossom Kerr @bblxssom on Github" name="author" />
    <link href="{{asset('/admin-assets/assets/plugins/pace/pace-theme-flash.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/admin-assets/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/admin-assets/assets/plugins/font-awesome/css/font-awesome.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/admin-assets/assets/plugins/jquery-scrollbar/jquery.scrollbar.css')}}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{asset('/admin-assets/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{asset('/admin-assets/assets/plugins/switchery/css/switchery.min.css')}}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{asset('/admin-assets/pages/css/pages-icons.css')}}" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="{{asset('/admin-assets/pages/css/themes/modern.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('/admin-assets/css/custom-login.css')}}">
    <script type="text/javascript">
        window.onload = function()
        {
            // fix for windows 8
            if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
                document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="/admin-assets/pages/css/windows.chrome.fix.css" />'
        }
    </script>
</head>
<body class="fixed-header ">
<div class="login-wrapper ">
    <!-- START Login Background Pic Wrapper-->
    <div class="bg-pic">
        <!-- START Background Pic-->
        <img src="{{asset('/admin-assets/images/background.jpg')}}" data-src="{{asset('/admin-assets/images/background.jpg')}}" data-src-retina="{{asset('/admin-assets/images/background.jpg')}}" alt="Hotel" class="lazy">
        <!-- END Background Pic-->
        <!-- START Background Caption-->
        <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
            <h2 class="semi-bold text-white" style="display: none">
                Pages make it easy to enjoy what matters the most in the life</h2>
            <p class="small" style="display: none">
                © 2017 Miratara CO.,LTD. All right reserved. Degihned and developed by <a href="https://www.degitobangkok.com">DEGITO</a></p>
        </div>
        <!-- END Background Caption-->
    </div>
    <!-- END Login Background Pic Wrapper-->
    <!-- START Login Right Container-->
    @yield('right-container')
    <!-- END Login Right Container-->
</div>

<!-- BEGIN VENDOR JS -->
<script src="{{asset('/admin-assets/assets/plugins/pace/pace.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin-assets/assets/plugins/jquery/jquery-1.11.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin-assets/assets/plugins/modernizr.custom.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin-assets/assets/plugins/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin-assets/assets/plugins/tether/js/tether.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin-assets/assets/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin-assets/assets/plugins/jquery/jquery-easy.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin-assets/assets/plugins/jquery-unveil/jquery.unveil.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin-assets/assets/plugins/jquery-ios-list/jquery.ioslist.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin-assets/assets/plugins/jquery-actual/jquery.actual.min.js')}}"></script>
<script src="{{asset('/admin-assets/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/admin-assets/assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/admin-assets/assets/plugins/classie/classie.js')}}"></script>
<script src="{{asset('/admin-assets/assets/plugins/switchery/js/switchery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/admin-assets/assets/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<!-- END VENDOR JS -->
<script src="{{asset('/admin-assets/pages/js/pages.min.js')}}"></script>

</body>
</html>