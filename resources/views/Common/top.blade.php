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
    <!-- endinject -->{{--
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" />--}}

    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->


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
                    <a class="nav-link" href="/forumdet/index">
                        <i class="mdi mdi-account"></i>
                        进入论坛
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
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
@show

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        @section('left')
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div id="sidebar11">
            <ul class="nav">
                <li class="nav-item nav-profile">
                    <a href="#" class="nav-link">
                        <div class="nav-profile-image">
                            <img src="{{asset('images/faces/face1.jpg')}}" alt="profile">
                            <span class="login-status online"></span> <!--change to offline or busy as needed-->
                        </div>
                        <div class="nav-profile-text d-flex flex-column">
                            <span class="font-weight-bold mb-2">
                                {{$name}}


                            </span>
                            <span class="text-secondary text-small">
                                @if($role=='master')
                                   超管
                                @elseif($role=='student')
                                    学生
                                @elseif($role=='teacher')
                                    老师
                                @elseif($role=='address')
                                   实习基地
                                @endif
                                 </span>
                        </div>
                        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                    </a>
                </li>
                @if($role=='master')
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('personal')}}">
                            <span class="menu-title">个人中心</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                            <span class="menu-title">用户管理</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-account menu-icon"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{url('/user/fa')}}">院系专业管理</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{url('/user/te')}}">教师管理</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{url('/user/stu')}}">学生管理</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{url('/user/address')}}">实习地点管理</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('group')}}">
                            <span class="menu-title">实习组管理</span>
                            <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('mission')}}">
                            <span class="menu-title">实习任务管理</span>
                            <i class="mdi mdi-comment-text-outline menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('forum')}}">
                            <span class="menu-title">论坛管理</span>
                            <i class="mdi mdi-forum menu-icon"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('message')}}">
                            <span class="menu-title">短消息管理</span>
                            <i class="mdi mdi-message-processing  menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('news')}}">
                            <span class="menu-title">公告管理</span>
                            <i class="mdi mdi-volume-medium  menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('count')}}">
                            <span class="menu-title">数据统计</span>
                            <i class="mdi mdi-chart-bar menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('setting')}}">
                            <span class="menu-title">网站配置</span>
                            <i class="mdi mdi-settings menu-icon"></i>
                        </a>
                    </li>

                @elseif($role=='teacher')
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('personal')}}">
                            <span class="menu-title">个人中心</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"   href="/user/stu/" >
                            <span class="menu-title">学生管理</span>
                            <i class="mdi mdi-account menu-icon"></i>
                        </a>

                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('groupTea')}}">
                            <span class="menu-title">实习组管理</span>
                            <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('mission')}}">
                            <span class="menu-title">实习任务管理</span>
                            <i class="mdi mdi-comment-text-outline menu-icon"></i>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="{{url('message')}}">
                            <span class="menu-title">短消息管理</span>
                            <i class="mdi mdi-message-processing  menu-icon"></i>
                        </a>
                    </li>
                @elseif($role=='student')
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('personal')}}">
                            <span class="menu-title">个人中心</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="{{url('group/stu')}}">
                            <span class="menu-title">实习组</span>
                            <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('missions')}}">
                            <span class="menu-title">实习任务</span>
                            <i class="mdi mdi-comment-text-outline menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('jiuye')}}">
                            <span class="menu-title">就业信息填写</span>
                            <i class="mdi mdi-forum menu-icon"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('message')}}">
                            <span class="menu-title">短消息</span>
                            <i class="mdi mdi-message-processing  menu-icon"></i>
                        </a>
                    </li>
                @elseif($role=='address')
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('personal')}}">
                            <span class="menu-title">个人中心</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="{{url('user/addressPfStu')}}">
                            <span class="menu-title">学生管理</span>
                            <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('zhaopin')}}">
                            <span class="menu-title">发布招聘信息</span>
                            <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('message')}}">
                            <span class="menu-title">短消息管理</span>
                            <i class="mdi mdi-chart-bar menu-icon"></i>
                        </a>
                    </li>
                    @endif
                    </span>









                <li class="nav-item sidebar-actions">
            <span class="nav-link">
              <div class="border-bottom">
                  <h6 class="font-weight-normal mb-3"></h6>
              </div>
              <button class="btn btn-block btn-lg btn-gradient-primary mt-4">HAPPY</button>

            </span>
                </li>
            </ul>
            </div>
        </nav>

        @show
        <!-- partial -->

        <div class="main-panel">


            <div class="content-wrapper">
                <div class="row">
                    <div class="col-12">
              <span class="d-flex align-items-center purchase-popup">
                <p><h3 style="margin-left: 50px">实践是思想的真理</h3>  <span style="float: right; margin-left: 200px">——车尔尼雪夫斯基</span></p>
              </span>
                    </div>
                </div>
                @section('content')
                @show
            </div>
            <!-- content-wrapper ends -->



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

            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
        <!-- page-body-wrapper ends -->
</div>


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