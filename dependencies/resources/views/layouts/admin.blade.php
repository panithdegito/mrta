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
    <link href="{{asset('/admin-assets/assets/plugins/dropzone/css/dropzone.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/admin-assets/assets/plugins/jquery-scrollbar/jquery.scrollbar.css')}}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{asset('/admin-assets/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{asset('/admin-assets/assets/plugins/switchery/css/switchery.min.css')}}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{asset('/admin-assets/pages/css/pages-icons.css')}}" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="{{asset('/admin-assets/pages/css/themes/modern.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/admin-assets/css/custom-admin.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/admin-assets/icon/style.css')}}" rel="stylesheet" type="text/css">
    @yield('top-scripts')

</head>
<body class="fixed-header horizontal-menu horizontal-app-menu ">
<!-- START PAGE-CONTAINER -->
<div class="header p-r-0 bg-white">
    <div class="header-inner header-md-height">
        <a href="#" class="btn-link toggle-sidebar hidden-lg-up pg pg-menu text-orange" data-toggle="horizontal-menu"></a>
        <div class="menu-bar-hotel">
            <div class="brand inline no-border hidden-xs-down">
                <img src="{{asset('/admin-assets/images/logo.svg')}}" alt="MRTA ORANGE LINE" data-src="{{asset('/admin-assets/images/logo.svg')}}" data-src-retina="{{asset('/admin-assets/images/logo.svg')}}" height="30" style="vertical-align: middle;margin-top: 13px">

            </div>
            <div class="container" style="text-align: center">
                <!-- START NOTIFICATION LIST -->
                <ul class="hidden-md-down notification-list no-margin hidden-sm-down b-grey b-l b-r no-style p-l-30 p-r-20">
                    @if (!Auth::guest())
                        <li class="p-r-10 inline menu-item">
                            <div class="p-r-10 fs-14 font-heading hidden-md-down text-orange" style="text-align: center">
                                <a href="{{route('dashboard')}}" class="fs-14 font-heading hidden-md-down text-orange">
                                    <i class="icon-statistic" style="font-size: 30px"></i><br>
                                    แดชบอร์ด
                                </a>
                            </div>
                        </li>
                        @can('ข่าวสารและกิจกรรม')
                            <li class="p-r-10 inline menu-item">
                                <div class="p-r-10 fs-14 font-heading hidden-md-down text-orange" style="text-align: center">
                                    <a href="{{route('news.index')}}" class="fs-14 font-heading hidden-md-down text-orange">
                                        <i class="icon-news" style="font-size: 30px"></i><br>
                                        ข่าวสาร
                                    </a>
                                </div>
                            </li>
                            @endcan
                        @can('หน้าเว็บ')
                            <li class="p-r-10 inline menu-item">
                                <div class="p-r-10 fs-14 font-heading hidden-md-down text-orange" style="text-align: center">
                                    <a href="{{route('pages.index')}}" class="fs-14 font-heading hidden-md-down text-orange">
                                        <i class="icon-page" style="font-size: 30px"></i><br>
                                        หน้าเว็บ
                                    </a>
                                </div>
                            </li>
                            @endcan
                        @can('เมนู')
                            <li class="p-r-10 inline menu-item">
                                <div class="p-r-10 fs-14 font-heading hidden-md-down text-orange" style="text-align: center">
                                    <a href="{{route('menus.index')}}" class="fs-14 font-heading hidden-md-down text-orange">
                                        <i class="icon-menu" style="font-size: 30px"></i><br>
                                        เมนู
                                    </a>
                                </div>
                            </li>
                            @endcan
                        @can('มีเดีย')
                            <li class="p-r-10 inline menu-item">
                                <div class="p-r-10 fs-14 font-heading hidden-md-down text-orange" style="text-align: center">
                                    <a href="{{route('media.index')}}" class="fs-14 font-heading hidden-md-down text-orange">
                                        <i class="icon-picture" style="font-size: 30px"></i><br>
                                        มีเดีย
                                    </a>
                                </div>
                            </li>
                            @endcan
                        @can('ความคืบหน้าโครงการ')
                            <li class="p-r-10 inline menu-item">
                                <div class="p-r-10 fs-14 font-heading hidden-md-down text-orange" style="text-align: center">
                                    <a href="{{route('stations.index')}}" class="fs-14 font-heading hidden-md-down text-orange">
                                        <i class="icon-helmet" style="font-size: 30px"></i><br>
                                        โครงการ
                                    </a>
                                </div>
                            </li>
                            @endcan
                        @can('ตั้งค่า')
                            <li class="p-r-10 inline menu-item">
                                <div class="p-r-10 fs-14 font-heading hidden-md-down text-orange" style="text-align: center">
                                    <a href="{{route('users.index')}}" class="fs-14 font-heading hidden-md-down text-orange">
                                        <i class="icon-setting" style="font-size: 30px"></i><br>
                                        ตั้งค่า
                                    </a>
                                </div>
                            </li>
                            @endcan




                    @endif



                </ul>
                <!-- END NOTIFICATIONS LIST -->
            </div>
       </div>
        <div class="d-flex align-items-center">
            <!-- START User Info-->
            <div class="pull-left p-r-10 fs-14 font-heading hidden-md-down text-orange">
                <span class="semi-bold">{{ Auth::user()->name }}</span>
            </div>
            <div class="dropdown pull-right">
                <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="thumbnail-wrapper d32 circular inline sm-m-r-5">
                <i class="icon-users text-orange" style="font-size: 30px"></i>
              </span>
                </button>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
                    <a href="#" class="dropdown-item"><i class="pg-settings_small"></i> ข้อมูลส่วนตัว</a>
                    <a href="#" class="dropdown-item"><i class="pg-outdent"></i> ฟีตแบค</a>
                    <a href="#" class="dropdown-item"><i class="pg-signals"></i> ช่วยเหลือ</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  class="clearfix bg-master-lighter dropdown-item">
                            <span class="pull-left">ออกจากระบบ</span>
                            <span class="pull-right"><i class="pg-power"></i></span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                </div>
            </div>
            <!-- END User Info-->
        </div>
    </div>
    @yield('mini-menu')
</div>
<div class="page-container ">
    <!-- START PAGE CONTENT WRAPPER -->
    <div class="page-content-wrapper ">
        <!-- START PAGE CONTENT -->
        <div class="content ">
            @yield('container')
        </div>
        <!-- END PAGE CONTENT -->
        <!-- START COPYRIGHT -->
        <!-- START CONTAINER FLUID -->
        <!-- START CONTAINER FLUID -->
        <div class=" container   container-fixed-lg footer">
            <div class="copyright sm-text-center">
                <p class="small no-margin pull-left sm-pull-reset">
                    <span class="hint-text">สงวนลิขสิทธิ์ © 2018</span>
                    <span class="">การรถไฟฟ้าขนส่งมวลชนแห่งประเทศไทย</span>.
                    <span class="sm-block"><a href="#" class="m-l-10 m-r-10">Terms of use</a> <span class="muted">|</span> <a href="#" class="m-l-10">Privacy Policy</a></span>
                </p>
                <p class="small no-margin pull-right sm-pull-reset">
                    ออกแบบและพัฒนาโดย <a href="https://www.degitobangkok.com/" target="_blank">DEGITO</a>
                </p>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- END COPYRIGHT -->
    </div>
    <!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END PAGE CONTAINER -->

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
<script src="{{asset('/admin-assets/assets/plugins/bootstrap-typehead/typeahead.bundle.min.js')}}"></script>
<script src="{{asset('/admin-assets/assets/plugins/bootstrap-typehead/typeahead.jquery.min.js')}}"></script>
<script src="{{asset('/admin-assets/assets/plugins/dropzone/dropzone.js')}}"></script>
<!-- END VENDOR JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<script src="{{asset('/admin-assets/pages/js/pages.min.js')}}"></script>
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="{{asset('/admin-assets/assets/js/scripts.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->
@yield('bottom-scripts')
</body>
</html>