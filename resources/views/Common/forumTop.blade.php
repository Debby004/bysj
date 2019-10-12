<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')--学生实习就业管理平台</title>
    <link rel="stylesheet" href="{{asset('vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" />

    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
</head>
<body>
<div class="container-scroller">
    @section('header')
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href=""><img src="{{asset('images/logo.svg')}}" alt="logo"/></a>
                <a class="navbar-brand brand-logo-mini" href=""><img src="{{asset('images/logo-mini.svg')}}" alt="logo"/></a>
            </div>

            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <div class="search-field d-none d-md-block">

                </div>

                <ul class="navbar-nav navbar-nav-right">


                    <li class="nav-item ">
                        <a class="nav-link" href="/personal">
                            <i class="mdi mdi-account"></i>
                            个人中心
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="/message">
                            <i class="mdi mdi-email-outline"></i>
                            短消息
                        </a>
                    </li>
                    <li class="nav-item d-none d-lg-block full-screen-link">
                        <a class="nav-link">
                            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                            全屏
                        </a>
                    </li>

                    <li class="nav-item nav-settings d-none d-lg-block">
                        <a class="nav-link" href="/out">
                            <i class="mdi mdi-exit-to-app"></i>
                            退出
                        </a>
                    </li>
                </ul>

            </div>
        </nav>
    @show
        <div class="container-scroller">
            <!-- partial:partials/_navbar.html -->


            <div class="row">

                <div class="col-2 ">
                </div>
                <div class="col-8">

                    <div class="main">

                        <div class="content">
                            <div class="row">
                                <div class="col-12">
              <span class="d-flex align-items-center purchase-popup">
               <a href="#" target="_blank" class="btn ml-auto download-button">悄悄的走过来 ---- xiall</a>
                <i class="mdi mdi-close popup-dismiss"></i>
              </span>
                                </div>
                            </div>
                            <div class="page-header">
                                @foreach($set_list as $kkf=>$vvf)
                                <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
              </span>

                                   {{$vvf->text}}
                                    学生实习就业平台论坛
                                </h3>
                                <nav aria-label="breadcrumb">
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item active" aria-current="page">
                                            <img style="width: 180px;height: 50px;" src="{{asset('uploads/stuMission')}}/{{$vvf->file_name}}">
                                   {{--         <span></span>Smile
                                            <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>--}}
                                        </li>
                                    </ul>
                                </nav>
                                @endforeach
                            </div>
@section('content')

@show

</div>
</div>

<div class="col-2">
</div>
</div>
</div>
</div>



`
                @section('footer')
                        <!-- partial:partials/_footer.html -->

                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2019 <a href="" target="_blank">BootstrapDash</a>. All rights reserved. </span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with
              <i class="mdi mdi-heart text-danger"></i> - Debby <a href="" target="_blank" title="Debby">Home  of Debby</a> - Collect from <a href="" title="教育实习" target="_blank">教育实习</a></span>
                    </div>
                </footer>

                @show



<!-- container-scroller -->


<script>
    $(document).ready(function(){
        $("#sidebar11 .menu_nva:eq(0)").show();
//        $("#firstpaneDiv h3.menu_head").click(function(){
//            $(this).addClass("current").next("div.menu_nva").slideToggle(200).siblings("div.menu_nva").slideUp("slow");
//            $(this).siblings().removeClass("current");
//        });
//        $("#secondpane .menu_nva:eq(0)").show();
//        $("#secondpane h3.menu_head").mouseover(function(){
//            $(this).addClass("current").next("div.menu_nva").slideDown(400).siblings("div.menu_nva").slideUp("slow");
//            $(this).siblings().removeClass("current");
//        });
    });
</script>


<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<!-- plugins:js -->
<script src="{{asset('vendors/js/vendor.bundle.base.js')}}"></script>
<script src="{{asset('vendors/js/vendor.bundle.addons.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{asset('js/off-canvas.js')}}"></script>
<script src="{{asset('js/misc.js')}}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{asset('js/dashboard.js')}}"></script>
<!-- End custom js for this page-->

<!-- Custom js for this page-->
<script src="{{asset('js/chart.js')}}"></script>
</body>

</html>