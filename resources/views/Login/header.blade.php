
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>登录--学生实习就业管理平台</title>
    <link rel="stylesheet" href="{{asset('vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" />

    <!-- CSS 及 JavaScript -->
</head>
<body>

<div class="container-scroller">
@section('content')
@show

        <!-- page-body-wrapper ends -->
</div>

<script src="{{asset('vendors/js/vendor.bundle.base.js')}}"></script>
<script src="{{asset('vendors/js/vendor.bundle.addons.js')}}"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="{{asset('js/off-canvas.js')}}"></script>
<script src="{{asset('js/misc.js')}}"></script>
<script type="text/javascript">

    $(document).ready(function(){
        $("#login").click(function(){
            if($('#account').val() == ''){
                alert("登录名不可以为空");
                $('#account').val('');
                $('#account').focus();
            }else if($('#password').val()==''){
                alert("密码不可以为空");
                $('#tpwd').val('');
                $('#password').focus();
            }else if($('#checkNum').val()==''){
                alert("验证码不可以为空");
                $('#checkNum').val('');
                $('#checkNum').focus();
            }else{
                Login_Control.login();
            }

        })
    });

    var Login_Control =
    {
        login:function(){

            var form = document.getElementById('loginForm');
            form.submit();
        }
    }





</script>
</body>
</html>