
@extends('Login.header')


@section('content')


<div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
            <div class="col-lg-4 mx-auto">
                <div class="auth-form-light text-left p-5">
                    <div class="brand-logo" >
                        <img src="{{asset('images/logo.svg')}}">
                    </div>
                    <h4>欢迎登录-----学生实习就业管理平台 </h4>
                    <form class="pt-3" method="post" id="loginForm"  action="{{url('/check')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="email" class="form-control form-control-lg" name="account" id="account" placeholder="账号">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="密码">
                        </div>
                        <div class="mt-3">
                            <a class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" id="login">登录</a>
                        </div>
                        <div class="my-2 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <label class="form-check-label text-muted">
                                    <input type="checkbox" class="form-check-input">
                                    记住密码
                                </label>
                            </div>
                            <a href="#" class="auth-link text-black">忘记密码?</a>
                        </div>
                        <div class="mb-2">
                            <button type="button" onclick="te();" class="btn btn-block btn-facebook auth-form-btn">
                                注册
                            </button>
                        </div>
                        <div class="text-center mt-4 font-weight-light">
                            没有账号? <a  href="#" class="text-primary">立即注册</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
    <script>
        function te() {
           alert('注册功能暂未开通！请联系学校管理员添加账号！')
        }
    </script>
    @stop